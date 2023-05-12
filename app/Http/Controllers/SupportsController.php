<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;
use App\models\User;
use App\models\Rating;
use App\models\Like;
use App\models\Support;
use Image;

class SupportsController extends Controller
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
        if(auth()->user()->tipo == 'asesor' || auth()->user()->tipo == 'admin'){
            $tickets=Support::where('active','pending')->orderBy('created_at','asc')->get();
            return view('support.indexanswer')->with('tickets',$tickets);
        }
        $tickets=Support::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        return view('support.index')->with('tickets',$tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('support.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['asunto'=>'required','descripcion'=>'required', 'foto'=>'nullable|max:4999']);


        $pqrs = new Support;
        $pqrs -> asunto = $request->input('asunto');
        $pqrs -> descripcion = $request->input('descripcion');
        if($request->hasFile('foto')){
            $image = $request->file('foto');
            $filename = time(). '.'. $image->getClientOriginalExtension();
            Image::make($image)->save( public_path('/uploads/PQRS/'.$filename));

            $pqrs -> image = $filename;
        }
        $pqrs -> user_id = $request->input('user_id');
        $pqrs -> save();

        return redirect('/supports')->with('success','Se ha enviado correctamente su ticket');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Support::find($id);
        $asesor='';
        if(auth()->user()->tipo == 'asesor' || auth()->user()->tipo == 'admin'){
            return view('support.answer')->with('ticket',$ticket);
        }
        if(auth()->user()->id != $ticket->user_id){
            return redirect('/supports')->with('error','Pagina no autorizada');
        }
        if($ticket->asesor!=NULL){
            $asesor=User::select('name')->where('username',$ticket->asesor)->get();
        }
        return view('support.show')->with('ticket',$ticket)->with('asesor',$asesor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,['respuesta'=>'required']);
        $ticket=Support::find($id);
        $ticket->respuesta=$request->input('respuesta');
        $ticket->asesor=$request->input('asesor');
        if($request->input('correct')=='si'){
            $ticket->active='resolved';
        }else{
            $ticket->active='finished';
        }
        $ticket->save();

        return redirect('/supports')->with('success','Se ha registrado la respuesta satisfactoriamente');
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
