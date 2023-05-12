<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;
use App\models\User;
use App\models\Rating;
use App\models\Like;

class LikesController extends Controller
{
    
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['user_id'=>'required','post_id'=>'required']);
        $validation=Like::where('user_id',$request->input('user_id'))
        ->where('post_id',$request->input('post_id'))->first();
        if ($validation == null){
            $like = new Like;
            $like -> user_id = $request->input('user_id');
            $like -> post_id = $request->input('post_id');
            $like -> active = 'yes';
            $like -> save();
        }else{
            if($validation->active == 'yes'){
                $like = Like::find($validation->id);
                $like -> user_id = $request->input('user_id');
                $like -> post_id = $request->input('post_id');
                $like -> active = 'no';
                $like -> save();
            }
            if($validation->active == 'no'){
                $like = Like::find($validation->id);
                $like -> user_id = $request->input('user_id');
                $like -> post_id = $request->input('post_id');
                $like -> active = 'yes';
                $like -> save();
            }
        }
        
        $post_id=Post::find($request->input('post_id'));
        $post_id->likes=Like::where('post_id', $request->input('post_id'))->where('active','yes')->count();
        $post_id -> save();

        $post=$request->input('post_id');
        return redirect('/posts/'.$post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
