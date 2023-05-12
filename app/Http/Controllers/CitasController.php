<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cita;
use App\models\Post;
use App\models\User;
use App\models\Rating;
use DB;
use Auth;

class CitasController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
        }
        if (auth()->user()->tipo == 'trabajador'){
            $worker = User::find(auth()->user()->id);
            $posts1= $worker -> posts;  
            foreach ($posts1 as $post){
                $citas[]=Cita::where('post_id',$post->id)->where('active','yes')->orderBy('created_at','desc')->get();
            }
            //return $cita;
            return view('citas.index')->with('citas',$citas);
        }else{
            return redirect('posts')->with('error','Pagina no Autorizada');
        }
    }

    public function index2()
    {
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
        }      
        if (Auth::guest() || auth()->user()->tipo == 'asesor' || auth()->user()->tipo == 'admin'){
            return redirect('posts')->with('error','Pagina no Autorizada');
        }
        $id=auth()->user()->id;
        $user=User::find($id);
        $citas=Cita::where('user_id',$user->id)->where('active','yes')->orderBy('created_at','desc')->get();
        //return $cita;
        return view('citas.index2')->with('citas',$citas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
        }
        $posts=Post::find($id);
        $rating=Rating::select('estrellas')->where('user_id',$posts -> user -> id)->where('active','yes')->avg('estrellas'); 
        $count=Rating::select('estrellas')->where('user_id',$posts -> user -> id)->where('active','yes')->count();
        if($posts==null){
            return redirect('posts')->with('error','Pagina no encontrada');
        }
        if(Auth()->user()->id == $posts -> user_id){
            return redirect('posts')->with('error','Pagina no autorizada');
        }
        return view('citas.create')->with('posts',$posts)->with('count',$count)->with('rating',$rating);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['fecha'=>'required','address'=>'required']);
        $cita = new Cita;
        $cita -> fecha_cita = $request -> input('fecha');
        $cita -> ubicacion = $request -> input('address');
        $cita -> estado = 'pendiente';
        $cita -> user_id = auth()->user()->id;
        $cita -> post_id = $request -> input('post_id');
        $cita -> save();

        return redirect('/posts')->with('success', 'Se ha agendado la cita');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $cita=Cita::find($id);
        
        $cita->estado = 'confirmada';
        $cita->save();

        return redirect('/citas');
    }

    public function cancel($id)
    {
        $cita=Cita::find($id);
        if($cita->fecha_cita < now()){
            $cita -> estado = 'descartada';
            $cita -> save();
        }else{
            $cita -> estado = 'rechazada';
            $cita->save();
        }
        return redirect('/citas');
    }

    public function usercancel($id)
    {
        $cita=Cita::find($id);
        if($cita->fecha_cita < now()){
            $cita -> estado = 'descartada';
            $cita -> save();
        }else{
            $cita -> estado = 'cancelada';
            $cita->save();
        }
        return redirect('/citas2');
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
