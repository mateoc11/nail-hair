@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-1" style="width: 75%;"><br>
        <a href="/validate/" class="btn btn-primary"><i class="fa-solid fa-backward"></i> Regresar</a><br><br>
            <h3 >Usuario a validar: </h3>
            <div class="card">
            <div class="py-8 bg-light"><br>
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-1 g-8">
                    <div class="col" style="width: 100%;">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #b960eb;">Trabajador: </h5>    
                                    <p class="card-text" style="font-size: 18pt;display:inline;"><img src="/uploads/avatars/{{$user->avatar}}"style="width: 150px;height: 150px;top: 10px;border-radius:20%;margin: 5px;">
                                    <strong>{{$user->name}} ({{$user->email}})<br></strong></p>Celular: {{$user->cel}}<br>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <br>
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Descargar cedula adjunta:</h5><br>
                                    <p class="card-text"><i class="fa-solid fa-file-arrow-down fa-2xl" style="color: #b960ec;"></i> 
                                    <a href="/uploads/documents/{{$user->cedula}}" download>
                                    Descargar cedula</a></p>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Validar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Validación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Esta seguro de validar este usuario?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                {!! Form::open(['action'=>['App\Http\Controllers\ValidateController@update', $user->id], 'method' => 'POST']) !!}
                                    {{Form::submit('Validar', ['class'=>'btn btn-success'])}}
                                    {{Form::hidden('validar','true')}}
                                    {{Form::hidden('_method','PUT')}}
                                {!! Form::close() !!}
                            </div>
                            </div>
                        </div>
                        </div>


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger float-end" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            Invalidar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Validación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Esta seguro de invalidar este usuario?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                {!! Form::open(['action'=>['App\Http\Controllers\ValidateController@update', $user->id], 'method' => 'POST']) !!}
                                    {{Form::submit('Invalidar', ['class'=>'btn btn-danger'])}}
                                    {{Form::hidden('validar','false')}}
                                    {{Form::hidden('_method','PUT')}}
                                {!! Form::close() !!}
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div><br>
            </div>
            </div>
        </div>
@endsection