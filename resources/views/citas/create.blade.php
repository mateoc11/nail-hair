@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-1" style="width: 75%;">
        <br>
        <a href="/posts/" class="btn btn-primary"><i class="fa-solid fa-backward"></i> Regresar</a>
        <br>
            <h3 >Agendar una cita para el anuncio:</h3>
            <div class="card">
            <div class="py-8 bg-light"><br>
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-1 g-8">
                        <div class="col" width="100%">
                            <div class="card shadow-sm">
                                <img src="/uploads/banners/{{$posts -> banner1}}" class="card-img-top h-100"
                                    width="100%" height="225" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="/posts/{{$posts->id}}"
                                            style="color: #b960eb;text-decoration: none;">{{ $posts->title }}</a></h5>
                                    <p class="card-text">{{$posts->body}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #b960eb;">Creado por el trabajador: </h5>
                                    <p class="card-text" style="font-size: 18pt;display:inline;"><img src="/uploads/avatars/{{$posts->user->avatar}}"style="width: 50px;height: 50px;top: 10px;border-radius:20%;margin: 5px;"><strong>{{$posts->user->name}}</strong></p><br>
                                    @include('inc.stars')
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::open(['action'=>'App\Http\Controllers\CitasController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('fecha', 'Elija la fecha para su cita')}}<br>
                        <input type="datetime-local" id="fecha" name="fecha" style="width: 100%;">
                    </div>
                    <div class="form-group">
                        {{Form::label('address', 'En la direccion:')}}
                        {{Form::text('address', $posts -> address, ['class' => 'form-control','placeholder'=>'Body text','readonly'])}}
                    </div>
                        {{Form::hidden('post_id', $posts -> id, ['class' => 'form-control'])}}<br>
                    {{Form::submit('Agendar', ['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
                    <script language="javascript">
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0');
                        var yyyy = today.getFullYear();
                        today = yyyy + '-' + mm + '-' + dd + 'T00:00:00';
                        $('#fecha').attr('min',today);
                    </script>
                </div><br>
            </div>
            </div>
        </div>
@endsection