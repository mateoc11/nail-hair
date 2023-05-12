@extends('layouts.app2')

@section('content')  
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                <div class="card">
                    <div class="card-header">{{ __('Usuarios pendientes de validación') }}</div>
                    <div class="card-body table-responsive">
                        <h2>Los siguientes usuarios requieren validación: </h2>
                        @if(count($users) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Creado el:</th>
                                    <th>Nombre: </th>
                                    <th>Email: </th>
                                    <th>Verificar datos: </th>
                                </tr>
                            
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user -> created_at}}</td>
                                    <td>{{$user -> name}}</td>
                                    <td>{{$user -> email}}</td>
                                    <td><a href="/validate/{{$user->id}}" class="btn btn-primary">Verificar</a></td>
                                </tr>
                            @endforeach
                            </table>
                        @else
                            <p>No hay usuarios para validar</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection