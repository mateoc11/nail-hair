@extends('layouts.app2')

@section('content')
<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/avatars/{{$user -> avatar}}" style="width: 150px; height: 150px; float: left; border-radius: 40%; margin-right: 25px"></img>
            <br>
            @include('inc.stars')
            <a href="#reviews">Ver calificaciones..</a>
            <h2>{{$user->name}} </h2>
            <p>{{$user->email}}</p>
            <p>se unio el {{$user->created_at->format('d / m / Y')}}</p>
            @if(!Auth::guest())
                @if(Auth::user()->id == $user -> id)
                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Editar perfil
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar información</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form enctype="multipart/form-data" action="/profile" method="POST">
                        <label>Actualizar imagen de perfil</label>
                        <input class="form-control" type="file" name="avatar"><br>
                        <label>Cambiar nombre</label><br>
                        <input class="form-control" type="text" name="nombre" value="{{$user->name}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary">
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                @endif
            @endif
            <br>
@if($user->tipo != 'cliente')
    <div class="py-5">
    <div class="container">
    <h2>Anuncios de este usuario</h2><hr>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
       @if(count($posts) >= 1)
                @foreach($posts as $post)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="/uploads/banners/{{$post -> banner1}}" class="card-img-top h-100" width="100%" height="225" preserveAspectRatio="xMidYMid slice" focusable="false">
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
                            <div class="btn-group">
                            @if(!Auth::guest())
                            @if(Auth::user()->id == $post -> user_id)
                            <a href="/posts/{{$post -> id}}/edit" class="btn btn-sm btn-outline-secondary">Editar</a>
                            @endif
                            @endif
                            </div>
                            
                            <small class="text-muted"><img src="/uploads/avatars/{{$post->user->avatar}}" style="width: 32px;height: 32px;top: 10px;border-radius:20%;">{{$post->user->name}}</small>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p>Este usuario no tiene anuncios</p>
            @endif
        </div><br>
                @if(count($posts) >= 1)
                    <div class="container d-flex align-items-center justify-content-center">{{$posts->links()}}</div>
                @endif
            @endif
            <h2 id="reviews">Calificaciones</h2><hr>
            @if(count($ratings) > 0)
                <table class="table">
                    <tr>
                    </tr>
                    @foreach($ratings as $rt)
                        <tr>
                            <td><img src="/uploads/avatars/{{$rt->avatar}}" 
                            style="width: 65px;height: 65px;top: 10px;border-radius:20%;margin: 5px;">{{$rt->nombre}}</td>
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
                            </small>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>Este usuario no tiene calificaciones</p>
            @endif
        </div>
    </div>
</div>
<br>
@endsection
