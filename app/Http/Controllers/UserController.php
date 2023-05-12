<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\models\Post;
use App\models\User;
use App\models\Rating;
use Auth;
use Image;

class UserController extends Controller
{
    public function profile(){
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
        }
        $user=User::find(auth()->user()->id);
        $ratings=Rating::where('user_id',$user->id)->where('active','yes')->get();
        $rating=Rating::select('estrellas')->where('user_id',$user->id)->where('active','yes')->avg('estrellas');
        $posts=Post::where('user_id',$user->id)->where('active','yes')->paginate(6);
        $count=Rating::select('estrellas')->where('user_id',$user->id)->where('active','yes')->count();
        if($user==null){
            return redirect('posts')->with('error','Pagina no encontrada');
        }
        return view('profile')->with('user', $user)->with('count',$count)->
        with('rating',$rating)->with('ratings',$ratings)->with('posts',$posts);
    }

    public function update_avatar(Request $request){

        $this->validate($request,['avatar'=>'image|nullable|max:1999']);
        
        if($request->hasFile('avatar')){
            $user= Auth::user();
            $id=$user->id;
            if ($user->avatar!='default.jpg'){
                File::delete(public_path('/uploads/avatars/'.$user->avatar));
            }
            $avatar = $request->file('avatar');
            $filename = time(). '.'. $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/uploads/avatars/'.$filename));


            $user->avatar=$filename;
            $user->save();

            $ratings=Rating::where('usuario',$user->username)->where('active','yes')->get();

            foreach ($ratings as $rating){
                $rating->avatar=$filename;
                $rating->save();
            }
        }
        $user= Auth::user();
        $id=$user->id;
        if($request->input('nombre') != $user -> name){
            $ratings = Rating::where('usuario',$user->username)->where('active','yes')->get();
            $user->name=$request->input('nombre');
            $user->save();
            foreach ($ratings as $rating){
                $rating->nombre=$request->input('nombre');
                $rating->save();
            }
        }
        return redirect('/profiles/'.$id);
    }

    public function show($id)
    {
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
        }
        $user=User::find($id);
        $ratings=Rating::where('user_id',$user->id)->where('active','yes')->get();
        $rating=Rating::select('estrellas')->where('user_id',$user->id)->where('active','yes')->avg('estrellas'); 
        $count=Rating::select('estrellas')->where('user_id',$user->id)->where('active','yes')->count();
        $posts=Post::where('user_id',$user->id)->where('active','yes')->paginate(6);
        if($user==null){
            return redirect('posts')->with('error','Pagina no encontrada');
        }
        return view('profile')->with('user', $user)->with('count',$count)
        ->with('rating',$rating)->with('ratings',$ratings)->with('posts',$posts);
    }


}
