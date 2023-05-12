@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col" style="width: 75%;"><br>
        <a href="/admin/revision" class="btn btn-primary"><i class="fa-solid fa-backward"></i> Regresar</a>
            <br><br>
            <h3 >Usuario a revisar: </h3>
            <div class="card">
            <div class="py-8 bg-light"><br>
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-1 g-8">
                    <div class="col" style="width: 100%;">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #b960eb;">Usuario de tipo {{$user->tipo}}: </h5>    
                                    <p class="card-text" style="font-size: 18pt;display:inline;"><img src="/uploads/avatars/{{$user->avatar}}"style="width: 150px;height: 150px;top: 10px;border-radius:20%;margin: 5px;">
                                    <strong><a href="../../../profiles/{{$user->id}}">{{$user->name}} ({{$user->email}})</a><br></strong></p>
                                    @if($stars != 0)
                                        <i class="fas fa-star fa-lg" style="color: gold;"></i>{{$stars}}
                                    @else
                                        <i class="fas fa-star fa-lg" style="color: gold;"></i>Sin reviews
                                    @endif
                                    <br>Celular: {{$user->cel}}<br>
                                </div>
                            </div>  
                        </div>
                        @if($user->tipo == 'trabajador')
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
                            </div>
                            <div class="col">
                                <br>
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                    <h2>Anuncios de este usuario</h2><hr>
                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                        @if(count($posts) >= 1)
                                                    @foreach($posts as $post)
                                                    <div class="col">
                                                        <div class="card shadow-sm">
                                                            <img src="/uploads/banners/{{$post -> banner1}}" class="card-img-top h-100" width="100%" height="225" preserveAspectRatio="xMidYMid slice" focusable="false">
                                                            @if($post->active=='no')<small class="text-center" style="color: red;">inactivo</small> @else<small class="text-center" style="color: limegreen;">activo</small> @endif
                                                            <div class="card-body">
                                                            <h5 class="card-title"><a href="/posts/{{$post->id}}" style="color: #b960eb;text-decoration: none;">{{ $post->title }}</a></h5>
                                                            <p class="card-text">{{$post->body}}</p>
                                                            <small>Creado hace
                                                            @php(($date = \Carbon\Carbon::parse($post->created_at)->diffInDays()))
                                                            @if($date>0)
                                                                {{($post->created_at)->diffInDays()}} dias
                                                            @elseif(($post->created_at)->diffInHours()>0)
                                                                {{($post->created_at)->diffInHours()}} horas
                                                            @else
                                                                {{($post->created_at)->diffInMinutes()}} minutos
                                                            @endif
                                                            </small>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                
                                                                <small class="text-muted"><img src="/uploads/avatars/{{$post->user->avatar}}" style="width: 32px;height: 32px;top: 10px;border-radius:20%;">{{$post->user->name}}</small>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <p>Este usuario no tiene anuncios</p>
                                                @endif

                                    </div>
                                    <br>
                                    @if(count($posts) >= 1)
                                        <div class="container d-flex align-items-center justify-content-center">{{$posts->links()}}</div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="col">
                                <br>
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                    <h2>Citas Agendadas</h2><hr>
                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                        @if(count($citas) >= 1)
                                                    @foreach($citas as $cita)
                                                    <div class="col">
                                                        <div class="card shadow-sm">
                                                            <div class="card-body">
                                                            <h5 class="card-title">{{$cita->fecha_cita}}</h5>
                                                            <p class="card-text">{{$cita->ubicacion}}</p>
                                                            <small>Agendada hace
                                                            @php(($date = \Carbon\Carbon::parse($cita->created_at)->diffInDays()))
                                                            @if($date>0)
                                                                {{($cita->created_at)->diffInDays()}} dias
                                                            @elseif(($cita->created_at)->diffInHours()>0)
                                                                {{($cita->created_at)->diffInHours()}} horas
                                                            @else
                                                                {{($cita->created_at)->diffInMinutes()}} minutos
                                                            @endif
                                                            </small>
                                                            <div class="d-flex justify-content-between align-items-center">          
                                                                <small class="text-muted">{{$cita->estado}}</small>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <p>Este usuario no tiene citas agendadas</p>
                                                @endif

                                    </div>
                                    
                                </div>
                            </div>
                        <div class="col">
                            <br>
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h2 id="reviews">Calificaciones enviadas</h2><hr>
                                        @if(count($ratings) > 0)
                                            <table class="table">
                                                <tr>
                                                </tr>
                                                @foreach($ratings as $rt)
                                                    <tr>
                                                        <td><img src="/uploads/avatars/{{$rt->avatar}}" 
                                                        style="width: 65px;height: 65px;top: 10px;border-radius:20%;margin: 5px;"><br>{{$rt->nombre}}</td>
                                                        <td>
                                                        @if($rt -> estrellas == 0)
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                        @elseif($rt -> estrellas <= 0.5)
                                                            <i class="fas fa-star-half-alt fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                        @elseif($rt -> estrellas <= 1)
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                        @elseif($rt -> estrellas <= 1.5)
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star-half-alt fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                        @elseif($rt -> estrellas <= 2)
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                        @elseif($rt -> estrellas <= 2.5)
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star-half-alt fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                        @elseif($rt -> estrellas <= 3)
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                        @elseif($rt -> estrellas <= 3.5)
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star-half-alt fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                        @elseif($rt -> estrellas <= 4)
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="far fa-star fa-lg"></i>
                                                        @elseif($rt -> estrellas <= 4.5)
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star-half-alt fa-lg"></i>
                                                        @elseif($rt -> estrellas <= 5)
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                            <i class="fas fa-star fa-lg"></i>
                                                        @endif
                                                        <br>
                                                        {{$rt->comentario}}<br>
                                                        <small>hace
                                                            @php(($date = \Carbon\Carbon::parse($rt->created_at)->diffInDays()))
                                                            @if($date>0)
                                                                {{($rt->created_at)->diffInDays()}} dias
                                                            @else
                                                                {{($rt->created_at)->diffInHours()}} horas
                                                            @endif
                                                            <br>
                                                            Para: <a href="../../../profiles/{{$profile=(App\Models\User::find($rt->user_id))->id;}}">{{$profile=(App\Models\User::find($rt->user_id))->name;}}</a>
                                                        </small>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @else
                                            <p>Este usuario no ha enviado calificaciones</p>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <br>
                    @if($user->active == 'yes')
                        <div class="text-center">
                            Este usuario se encuentra activo, puede:<br>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-ban"></i> Bloquear
                            </button>
                            <br><br>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bloquear</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Esta seguro de bloquear este usuario?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                {!! Form::open(['action'=>['App\Http\Controllers\AdminController@ban', $user->id], 'method' => 'POST']) !!}
                                    {{Form::submit('Bloquear', ['class'=>'btn btn-danger'])}}
                                    {{Form::hidden('bloquear','true')}}
                                    {{Form::hidden('_method','PUT')}}
                                {!! Form::close() !!}
                            </div>
                            </div>
                        </div>
                    @elseif($user->active == 'no')
                        <div class="text-center">
                            Este usuario se encuentra desactivado/bloqueado, puede:<br>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-user-check">  </i> Desbloquear
                            </button>
                            <br><br>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Desbloquear</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Esta seguro de debloquear este usuario?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                {!! Form::open(['action'=>['App\Http\Controllers\AdminController@ban', $user->id], 'method' => 'POST']) !!}
                                    {{Form::submit('Desbloquear', ['class'=>'btn btn-success'])}}
                                    {{Form::hidden('bloquear','false')}}
                                    {{Form::hidden('_method','PUT')}}
                                {!! Form::close() !!}
                            </div>
                            </div>
                        </div>
                    @elseif($user->active == 'pending')
                        <div class="text-center">
                            Este usuario se encuentra pendiente de validación, puede:<br>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-check"></i> Activar
                            </button>
                            <br><br>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Activar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Esta seguro de activar este usuario?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                {!! Form::open(['action'=>['App\Http\Controllers\AdminController@ban', $user->id], 'method' => 'POST']) !!}
                                    {{Form::submit('Activar', ['class'=>'btn btn-success'])}}
                                    {{Form::hidden('bloquear','false')}}
                                    {{Form::hidden('_method','PUT')}}
                                {!! Form::close() !!}
                            </div>
                            </div>
                        </div>
                    @endif
                        
                    </div>
                </div><br>
            </div>
            </div>
        </div>
@endsection