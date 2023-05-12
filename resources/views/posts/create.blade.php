@extends('layouts.app2')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-1"><br>
            <div class="card">
                <h3 style="margin: 15px;">Crear Anuncio</h3>
                {!! Form::open(['action'=>'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="card shadow-none" style="margin: 15px;">
                        <h5 class="card-title"> Adjunte tres imagenes para su anuncio (Almenos una obligatoria)</h5>
                        <div class="card-body">
                            {{Form::file('banner1',['required'])}}*
                        </div>
                        <div class="card-body">
                            {{Form::file('banner2')}}   
                        </div>
                        <div class="card-body">
                            {{Form::file('banner3')}}   
                        </div>
                    </div>
                    <div class="form-group" style="margin: 15px;">
                        {{Form::label('title', 'Titulo*')}}
                        {{Form::text('title', '', ['class' => 'form-control','placeholder'=>'Titulo', 'required'])}}
                    </div>
                    <div class="form-group" style="margin: 15px;">
                        {{Form::label('body', 'Descripción*')}}
                        {{Form::text('body', '', ['class' => 'form-control','placeholder'=>'Descripción', 'required'])}}
                    </div>
                    <div class="form-group" style="margin: 15px;">
                        {{Form::label('address', 'Direccion*')}}
                        {{Form::text('address', '', ['class' => 'form-control','placeholder'=>'Direccion', 'required'])}}
                    </div><br>
                </div><br>
                    {{Form::submit('Crear', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection