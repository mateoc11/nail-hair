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

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show','index2']]);
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
        $posts=Post::where('active','yes')->orderBy('created_at','desc')->paginate(9);
        //$posts->orderBy('created_at','desc')->get();
        return view('posts.index')->with('posts',$posts);
    }

    public function index2()
    {
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
        }
        $posts=Post::where('active','yes')->orderBy('created_at','desc')->paginate(9);
        //$posts->orderBy('created_at','desc')->get();
        return view('posts.index2')->with('posts',$posts);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
            if (auth()->user()->tipo != 'trabajador'){
                return redirect('posts')->with('error','Usted no puede crear anuncios');
            }
        }
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required','body'=>'required','address'=>'required','banner1'=>'image|nullable|max:1999', 'banner2'=>'image|nullable|max:1999', 'banner3'=>'image|nullable|max:1999']);

        if($request->hasFile('banner1')){
            $file=$request->file('banner1');

            $filenameWithExt=$request->file('banner1')->getClientOriginalName();

            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);

            $extension=$request->file('banner1')->getClientOriginalExtension();

            $filenametostore=$filename.'_'.time().'.'.$extension;

            Image::make($file)->save( public_path('/uploads/banners/'.$filenametostore));

        }else{
            $filenametostore='banner1.jpg';
        }

        if($request->hasFile('banner2')){
            $file2=$request->file('banner2');

            $filenameWithExt2=$request->file('banner2')->getClientOriginalName();

            $filename2=pathinfo($filenameWithExt2,PATHINFO_FILENAME);

            $extension2=$request->file('banner2')->getClientOriginalExtension();

            $filenametostore2=$filename2.'_'.time().'.'.$extension2;

            Image::make($file2)->save( public_path('/uploads/banners/'.$filenametostore2));

        }else{
            $filenametostore2='banner1.jpg';
        }

        if($request->hasFile('banner3')){
            $file3=$request->file('banner3');

            $filenameWithExt3=$request->file('banner3')->getClientOriginalName();

            $filename3=pathinfo($filenameWithExt3,PATHINFO_FILENAME);

            $extension3=$request->file('banner3')->getClientOriginalExtension();

            $filenametostore3=$filename3.'_'.time().'.'.$extension3;

            Image::make($file3)->save( public_path('/uploads/banners/'.$filenametostore3));

        }else{
            $filenametostore3='banner1.jpg';
        }

        $post = new Post;
        $post->banner1=$filenametostore;
        $post->banner2=$filenametostore2;
        $post->banner3=$filenametostore3;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->address = $request->input('address');
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success', 'Se ha subido el anuncio');

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
        }

        $post=Post::find($id);
        $rating=Rating::select('estrellas')->where('user_id',$post -> user -> id)->where('active','yes')->avg('estrellas'); 
        $count=Rating::select('estrellas')->where('user_id',$post -> user -> id)->where('active','yes')->count();
        $likes=Like::where('post_id',$post -> id)->where('active','yes')->count();
        $like=null;
        if (!Auth::guest()){
            $like=Like::where('post_id',$post -> id)->where('user_id',Auth()->user()->id)->where('active','yes')->first();
        }
        if($post==null){
            return redirect('posts')->with('error','Pagina no encontrada');
        }
        if(!Auth::guest()){
            if ((auth()->user()->tipo != 'admin' && $post -> active == 'no')){
                return redirect('posts')->with('error','Pagina no encontrada');
            }
        }
        return view('posts.show')->with('post',$post)->with('count',$count)->with('rating',$rating)
        ->with('likes',$likes)->with('like',$like);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::guest()){
            if (auth()->user()->active != 'yes'){
                return redirect('pendiente');
            }
        }
        
        $post=Post::find($id);
        if($post==null){
            return redirect('posts')->with('error','Pagina no encontrada');
        }
        if(Auth()->user()->id != $post -> user_id &&     Auth()->user()->tipo != 'admin'){
            return redirect('posts')->with('error','Pagina no autorizada');
        }

        return view('posts.edit')->with('post',$post);
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
        $this->validate($request,['title'=>'required','body'=>'required','address'=>'required', 'banner1'=>'image|nullable|max:1999', 'banner2'=>'image|nullable|max:1999', 'banner3'=>'image|nullable|max:1999']);
        $post = Post::find($id);
        if($request->hasFile('banner1')){
            if($post->banner1 != 'banner1.jpg'){
                File::delete(public_path('/uploads/banners/'.$post->banner1));
            }
            $file=$request->file('banner1');

            $filenameWithExt=$request->file('banner1')->getClientOriginalName();

            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);

            $extension=$request->file('banner1')->getClientOriginalExtension();

            $filenametostore=$filename.'_'.time().'.'.$extension;

            Image::make($file)->save( public_path('/uploads/banners/'.$filenametostore));

        }

        if($request->hasFile('banner2')){
            if($post->banner2 != 'banner1.jpg'){
                File::delete(public_path('/uploads/banners/'.$post->banner2));
            }
            $file2=$request->file('banner2');

            $filenameWithExt2=$request->file('banner2')->getClientOriginalName();

            $filename2=pathinfo($filenameWithExt2,PATHINFO_FILENAME);

            $extension2=$request->file('banner2')->getClientOriginalExtension();

            $filenametostore2=$filename2.'_'.time().'.'.$extension2;

            Image::make($file2)->save( public_path('/uploads/banners/'.$filenametostore2));

        }

        if($request->hasFile('banner3')){
            if($post->banner3 != 'banner1.jpg'){
                File::delete(public_path('/uploads/banners/'.$post->banner3));
            }
            $file3=$request->file('banner3');

            $filenameWithExt3=$request->file('banner3')->getClientOriginalName();

            $filename3=pathinfo($filenameWithExt3,PATHINFO_FILENAME);

            $extension3=$request->file('banner3')->getClientOriginalExtension();

            $filenametostore3=$filename3.'_'.time().'.'.$extension3;

            Image::make($file3)->save( public_path('/uploads/banners/'.$filenametostore3));

        }

        
        if($request->hasFile('banner1')){
            $post->banner1=$filenametostore;
        }
        if($request->hasFile('banner2')){
            $post->banner2=$filenametostore2;
        }
        if($request->hasFile('banner3')){
            $post->banner3=$filenametostore3;
        }
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->address = $request->input('address');
        $post->save();

        return redirect('/posts')->with('success', 'Se ha editado el anuncio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        if($post==null){
            return redirect('posts')->with('error','Pagina no encontrada');
        }
        if(Auth()->user()->id != $post -> user_id && Auth()->user()->tipo != 'admin' ){
            return redirect('posts')->with('error','Pagina no autorizada');
        }
        /*if($post->banner1 != 'banner1.jpg'){
            File::delete(public_path('/uploads/banners/'.$post->banner1));
            $post->banner1 = 'banner1.jpg';
        }
        if($post->banner2 != 'banner1.jpg'){
            File::delete(public_path('/uploads/banners/'.$post->banner2));
            $post->banner2 = 'banner1.jpg';
        }
        if($post->banner3 != 'banner1.jpg'){
            File::delete(public_path('/uploads/banners/'.$post->banner3));
            $post->banner3 = 'banner1.jpg';
        }*/
        $post->active = 'no';
        $post->save();
        $citas=Cita::where('post_id',$post->id)->get();
        foreach($citas as $cita){
            $cita->estado = 'descartada';
            $cita->save();
        }
        return redirect('/posts')->with('success', 'Se ha eliminado el anuncio');
    }
}
