<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;
use App\models\User;
use App\models\Rating;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request,['estrellas'=>'required']);
        $post=$request->input('post');
        $reviews=Rating::where('user_id', $request->input('user_id'))->get();
        $username=$request->input('usuario');
        $valid=true;
        foreach ($reviews as $review){
            if($review -> usuario == $username){
                $valid=false;
            }
        }
        if ($valid == false){
            return redirect('/posts/'.$post)->with('error', 'Error: usted ya ha calificado antes a este trabajador');
        }
        $rating = new Rating;
        $rating -> nombre = $request->input('name');
        $rating -> usuario = $request->input('usuario');
        $rating -> avatar = $request->input('avatar');
        $rating -> comentario = $request->input('comentario');
        $rating -> estrellas = $request->input('estrellas');
        $rating -> user_id = $request->input('user_id');
        $rating -> save();
        $post=$request->input('post');
        return redirect('/posts/'.$post)->with('success', 'Se ha enviado la calificacion');
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
