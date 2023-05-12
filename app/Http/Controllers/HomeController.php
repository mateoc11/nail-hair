<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\models\Post;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
        }
        if(auth()->user()->tipo == 'trabajador'){
            $user_id=auth()->user()->id;
            $user = User::find($user_id);
            $posts = Post::where('user_id',$user_id)->where('active','yes')->get();
            return view('home')->with('posts',$posts);
        }else{
            return redirect('posts');
        }
    }

    public function validatepending(){
        if(!Auth::guest()){
            if (auth()->user()->active == 'yes'){
                return redirect('posts')->with('error','Pagina no autorizada');
            }
            if (auth()->user()->active == 'pending'){
                return view('pending')->with('error','Su cuenta aun esta pendiente de validacion recuerde que el tiempo estimado es de 24 a 48 horas');
            }
            if (auth()->user()->active == 'no'){
                return view('pending')->with('error','Su cuenta aun esta bloqueada o desactivada, pongase en contacto con PQRS para saber la razón');
            }
        }

    }
}
