@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tablero') }}</div>


                <div class="card-body table-responsive">
                    <a href="/posts/create" class="btn btn-primary">¡Crea un anuncio!</a><br><br>
                    <h2>Tus anuncios</h2>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Anuncio</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}" class="btn btn-primary">Ver anuncio</a></td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Editar</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-end'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Eliminar', ['class' => 'btn btn-danger'])}}  
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>No has creado ningun anuncio</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
