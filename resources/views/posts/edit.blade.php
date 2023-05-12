@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-1">
        <a href="/posts/" class="btn btn-primary"><i class="fa-solid fa-backward"></i> Regresar</a>
        <br><br>
            <div class="card">
                <h3 style="margin: 15px;">Editar post</h3>
                
                    {!! Form::open(['action'=>['App\Http\Controllers\PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="card" style="margin: 15px;">
                        <h5 class="card-title">Si desea cambiar las imagenes suba nuevos archivos</h5>
                        <div class="card-body">
                            {{Form::file('banner1')}}   
                        </div>
                        <div class="card-body">
                            {{Form::file('banner2')}}   
                        </div>
                        <div class="card-body">
                            {{Form::file('banner3')}}   
                        </div>
                    </div>
                    <div class="form-group" style="margin: 15px;">
                        {{Form::label('title', 'Titulo')}}
                        {{Form::text('title', $post -> title, ['class' => 'form-control','placeholder'=>'Title'])}}
                    </div>
                    <div class="form-group" style="margin: 15px;">
                        {{Form::label('body', 'Descripcion')}}
                        {{Form::text('body', $post -> body , ['class' => 'form-control','placeholder'=>'Body text'])}}
                    </div>
                    <div class="form-group" style="margin: 15px;">
                        {{Form::label('address', 'Direccion')}}
                        {{Form::text('address', $post -> address , ['class' => 'form-control','placeholder'=>'Direccion'])}}
                    </div>
                    {{Form::hidden('_method','PUT')}}
            </div><br>
                    {{Form::submit('Editar', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection