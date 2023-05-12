@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa-solid fa-backward"></i> Regresar</a>
            @if(!Auth::guest())
                @if(Auth::user()->id != $post -> user_id)
                     <a href="/citas/create/{{$post -> id}}" class="btn btn-warning float-end"><i class="fa fa-pencil" aria-hidden="true"></i>Agendar una cita</a>
                @endif
            @endif
            <br><br>
            @if (!Auth::guest())
                @if(Auth::user()->tipo == 'admin')
                    @if($post->active == 'yes')
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-ban"></i> Desactivar
                            </button>
                        </div><br>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Desactivar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Esta seguro de desactivar este anuncio?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    {!! Form::open(['action'=>['App\Http\Controllers\AdminController@banad', $post->id], 'method' => 'POST']) !!}
                                        {{Form::hidden('bloquear','true')}}
                                        {{Form::hidden('_method','PUT')}}
                                        {{Form::submit('Desactivar', ['class'=>'btn btn-danger'])}}
                                    {!! Form::close() !!}
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($post->active == 'no')
                        <div class="text-center">
                            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-circle-check"></i> Activar
                            </button>
                        </div><br>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Activar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Esta seguro de activar este anuncio?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    {!! Form::open(['action'=>['App\Http\Controllers\AdminController@banad', $post->id], 'method' => 'POST']) !!}
                                        {{Form::hidden('bloquear','false')}}
                                        {{Form::hidden('_method','PUT')}}
                                        {{Form::submit('Activar', ['class'=>'btn btn-success'])}}
                                    {!! Form::close() !!}
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endif  
            <div class="card">
                <br>
                <h2 style="color: #b960eb;text-decoration: none;margin-left: 50px;">{{$post  -> title}}</h2>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="width: 100%;">
                <div class="carousel-indicators">
                @if($post->banner2 != 'banner1.jpg' && $post->banner3 != 'banner1.jpg')
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                @endif
                @if(($post->banner2 != 'banner1.jpg' && $post->banner3 == 'banner1.jpg')||($post->banner2 == 'banner1.jpg' && $post->banner3 != 'banner1.jpg'))
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                @endif
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="/uploads/banners/{{$post -> banner1}}" class="d-block w-100" alt="...">
                    </div>
                    @if($post->banner2 != 'banner1.jpg')
                    <div class="carousel-item">
                    <img src="/uploads/banners/{{$post -> banner2}}" class="d-block w-100" alt="...">
                    </div>
                    @endif
                    @if($post->banner3 != 'banner1.jpg')
                    <div class="carousel-item">
                    <img src="/uploads/banners/{{$post -> banner3}}" class="d-block w-100" alt="...">
                    </div>
                    @endif
                </div>
                @if(($post->banner2 != 'banner1.jpg' || $post->banner3 != 'banner1.jpg'))
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                @endif
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                    @if(!Auth::guest())
                        {!!Form::open(['action' => ['App\Http\Controllers\LikesController@store'] , 'method' => 'POST'])!!}
                            {{Form::hidden('user_id', Auth::user()->id)}}
                            {{Form::hidden('post_id', $post->id)}}
                            <button type="submit" style="background-color: transparent;
                            background-repeat: no-repeat; border: none; cursor: pointer; overflow: hidden;
                            outline: none; height: 35px;"><i class="fas fa-thumbs-up fa-2xl"
                            @if ($like != null)
                                @if($like -> user_id == Auth::user()->id )
                                  style="color: blue;">
                                @endif
                            @else
                                  style="color: grey;">
                            @endif
                            </i></button>{{$likes}}
                        {!!Form::close()!!}
                    @else
                        <i class="fas fa-thumbs-up fa-2xl" style="color: grey;"></i> {{$likes}}
                    @endif
                    </li>
                </ul>
                <div class="card-body">
                    <h5> {{ $post->body }}</h5> 
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        {{$post  -> created_at}}
                        <div class="float-end">
                            <img src="/uploads/avatars/{{$post->user->avatar}}" style="width: 65px;height: 65px;top: 10px;border-radius:20%;margin: 5px;">
                            <a href="/profiles/{{$post->user->id}}" style="text-decoration: none;">{{$post->user->name}}</a><br>
                            @include('inc.stars')
                            <br>
                            @if(!Auth::guest())
                                @if(Auth::user()->id != $post -> user_id)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#rating" style="margin-left: 12px;">
                                      Calificar
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="rating" tabindex="-1" aria-labelledby="ratingLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ratingLabel">Calificando al trabajador: {{$post -> user -> name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        {!!Form::open(['action' => ['App\Http\Controllers\RatingsController@store'] , 'method' => 'POST'])!!}
                                            {{Form::hidden('user_id', $post->user->id)}}
                                            {{Form::hidden('name', Auth::user()->name)}}
                                            {{Form::hidden('usuario', Auth::user()->username)}}
                                            {{Form::hidden('avatar', Auth::user()->avatar)}}
                                            {{Form::hidden('post', $post -> id)}}
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="estrellas" id="estrellas" value="1">
                                                <label class="form-check-label" for="inlineRadio1">1</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="estrellas" id="estrellas" value="2">
                                                <label class="form-check-label" for="inlineRadio1">2</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="estrellas" id="estrellas" value="3">
                                                <label class="form-check-label" for="inlineRadio1">3</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="estrellas" id="estrellas" value="4">
                                                <label class="form-check-label" for="inlineRadio1">4</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="estrellas" id="estrellas" value="5">
                                                <label class="form-check-label" for="inlineRadio1">5</label>
                                            </div><br><br>
                                            {{Form::text('comentario', '', ['class' => 'form-control','placeholder'=>'Deje un comentario de su calificacion Opcional'])}}
                                    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            {{Form::submit('Enviar', ['class' => 'btn btn-primary'])}}
                                        </div>
                                        {!!Form::close()!!}
                                        </div>
                                    </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </li>
                </ul>
                </div>
                <br>
                @if(!Auth::guest())
                    @if(Auth::user()->id == $post -> user_id || Auth::user()->tipo == 'admin')
                    <a href="/posts/{{$post -> id}}/edit" class="btn btn-primary">Editar Anuncio</a>
                    {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-end'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::button('Eliminar', ['class' => 'btn btn-danger','data-bs-toggle'=>'modal','data-bs-target'=>'#exampleModal'])}}

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Confirme que desea eliminar este anuncio
                                </div>
                                <div class="modal-footer">
                                    {{Form::button('Cancelar', ['class' => 'btn btn-primary','data-bs-dismiss'=>'modal'])}}
                                    {{Form::submit('Eliminar', ['class' => 'btn btn-danger',])}}
                                </div>
                                </div>
                            </div>
                        </div>  
                    {!!Form::close()!!}
                    @endif
                @endif
            
    </div>

    </div>
</div>
<br>
@endsection('content')