<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;
use App\models\User;
use App\models\Rating;
use App\models\Like;
use Auth;

class ValidateController extends Controller
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
            if ((auth()->user()->tipo != 'asesor')&&(auth()->user()->tipo != 'admin')){
                return redirect('posts')->with('error','Pagina no autorizada');
            }
        }
        $users=User::where('active','pending')->orderBy('created_at','asc')->get();
        return view('validate.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
            if ((auth()->user()->tipo == 'asesor')&&(auth()->user()->tipo == 'admin')){
                return redirect('posts')->with('error','Pagina no autorizada');
            }
        }
        $user=User::find($id);
        return view('validate.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $user=User::find($id);
        if($request->input('validar')=='true'){
            $user->active='yes';
            $user->save();
        }else{
            $user->active='no';
            $user->save();
        }
        return redirect("/validate");
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
