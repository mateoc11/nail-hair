<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use App\models\Post;
use App\models\User;
use App\models\Rating;
use App\models\Like;
use App\models\Cita;
use Auth;
use Image;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function stats(Request $request)
    {
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
            if (auth()->user()->tipo != 'admin'){
                return redirect('posts')->with('error','Pagina no Autorizada');
            }
        }
        if(!count($request->all()) || $request->input("mes")==0){
            $now = Carbon::now();
            $month = 0;
            $users=[];
            $likes=[];
            $ratings=[];
            $posts=[];
            $citas=[];
            for ($i = 1; $i <= $now->month; $i++){
                $sum=User::whereMonth('created_at', $i )->whereYear('created_at', $now->year )->count();
                array_push($users,$sum);
            }
            for ($i = 1; $i <= $now->month; $i++){
                $sum=Like::whereMonth('created_at', $i )->whereYear('created_at', $now->year )->where('active','yes')->count();
                array_push($likes,$sum);
            }
            for ($i = 1; $i <= $now->month; $i++){
                $sum=Rating::whereMonth('created_at', $i )->whereYear('created_at', $now->year )->count();
                array_push($ratings,$sum);
            }
            for ($i = 1; $i <= $now->month; $i++){
                $sum=Post::whereMonth('created_at', $i )->whereYear('created_at', $now->year )->count();
                array_push($posts,$sum);
            }
            for ($i = 1; $i <= $now->month; $i++){
                $sum=Cita::whereMonth('created_at', $i )->whereYear('created_at', $now->year )->count();
                array_push($citas,$sum);
            }
            return view('admin.stats', ['likes' => $likes,'now' => $now,'users'=> $users,'month'=> $month,
            'ratings' => $ratings, 'posts' => $posts, 'citas' => $citas]);
        }elseif(count($request->all())){
            $now = Carbon::now();
            $users=[];
            $month = $request->input("mes");
            $likes=[];
            $ratings=[];
            $posts=[];
            $citas=[];
            $sum=User::whereMonth('created_at', $month )->whereYear('created_at', $now->year )->count();
            array_push($users,$sum);
            $sum=Like::whereMonth('created_at', $month )->whereYear('created_at', $now->year )->where('active','yes')->count();
            array_push($likes,$sum);
            $sum=Rating::whereMonth('created_at', $month )->whereYear('created_at', $now->year )->count();
            array_push($ratings,$sum);
            $sum=Post::whereMonth('created_at', $month )->whereYear('created_at', $now->year )->count();
            array_push($posts,$sum);
            $sum=Cita::whereMonth('created_at', $month )->whereYear('created_at', $now->year )->count();
            array_push($citas,$sum);
            return view('admin.stats', ['likes' => $likes,'now' => $now,'users'=> $users,'month'=> $month,'ratings' => $ratings,
            'posts' => $posts,'citas' => $citas]);
        }
    }

    public function revision(){
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
            if (auth()->user()->tipo != 'admin'){
                return redirect('posts')->with('error','Pagina no Autorizada');
            }
        }
        return view('admin.revision', []);
    }

    public function showuser($id){
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
            if (auth()->user()->tipo != 'admin'){
                return redirect('posts')->with('error','Pagina no Autorizada');
            }
        }
        $user=User::find($id);
        $ratings=Rating::where('usuario',$user->username)->where('active','yes')->get();
        $stars=Rating::select('estrellas')->where('user_id',$user->id)->where('active','yes')->avg('estrellas'); 
        $posts=Post::where('user_id',$user->id)->paginate(3);
        $citas=Cita::where('user_id',$user->id)->where('active','yes')->get();
        $stars=round($stars,2);
        return view('admin.ban', ['user' => $user,'ratings' => $ratings,'posts'=>$posts, 'citas' => $citas, 'stars' => $stars]);
    }


    public function ban(Request $request, $id)
    {
        $user=User::find($id);
        $posts=Post::where('user_id',$user->id)->get();
        if($request->input('bloquear') == 'true'){
            $user->active='no';
            $user->save();
            foreach($posts as $post){
                $post->active='no';
                $post->save();
            }
            $success='Se bloqueo al usuario correctamente';
        }else{
            $user->active='yes';
            $user->save();
            foreach($posts as $post){
                $post->active='yes';
                $post->save();
            }
            $success='Se activo al usuario correctamente';
        }
        return redirect("/admin/user/$user->id")->with('success',$success);
    }

    public function rolesindex(){
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
            if (auth()->user()->tipo != 'admin'){
                return redirect('posts')->with('error','Pagina no Autorizada');
            }
        }
        return view('admin.roles', []);
    }

    public function roleupdate(Request $request){
        $user=User::find($request->input('user_id'));
        $user->tipo=$request->input('rol');
        $user->save();
        return redirect('/admin/roles')->with('success','Se ha actualizado el rol correctamente');
    }

    public function banad(Request $request, $id)
    {
        $post=Post::find($id);
        if($request->input('bloquear') == 'true'){
            $post->active='no';
            $post->save();
            $success='Se desactivo el post correctamente';
        }else{
            $post->active='yes';
            $post->save();
            $success='Se activo al post correctamente';
        }
        return redirect("/anuncios")->with('success',$success);
    }

}
