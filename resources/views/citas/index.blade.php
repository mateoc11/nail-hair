@extends('layouts.app2')

@section('content')  
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                <div class="card">
                    <div class="card-header">{{ __('Citas para confirmar') }}</div>
                    <div class="card-body table-responsive">
                        <h2>Citas Agendadas para tus anuncios</h2>
                        @if(count($citas) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Fecha y Hora</th>
                                    <th>Direccion </th>
                                    <th>del Anuncio</th>
                                    <th>Solicitada por: </th>
                                    <th>Accion: </th>
                                </tr>
                            
                            @foreach($citas as $c)
                                @foreach($c as $a)
                                    <tr>
                                        <td>{{$a -> fecha_cita}}</a></td>
                                        <td>{{$a -> ubicacion}}</a></td>
                                        <td><a href="/posts/{{$a->post_id}}" class="text-dark">{{$a ->post->title}}</a></td>
                                        <td><img src="/uploads/avatars/{{$a->user->avatar}}" style="width: 35px;height: 35px;top: 10px;border-radius:20%;margin: 5px;">
                                        <a href="/profiles/{{$a->user->id}}" style="text-decoration: none;">{{$a->user->name}}</a></td>
                                        <td>
                                        @if ($a->estado == 'pendiente' && $a->fecha_cita > now())
                                        <a href="/citas/{{$a->id}}/confirm" class="btn btn-success" title="Confirmar"><i class="fa fa-check" aria-hidden="true"></i></a> <a href="/citas/{{$a->id}}/cancel" class="btn btn-danger" title="Rechazar">
                                        <i class="fa fa-times" aria-hidden="true"></i></a>
                                        @else
                                            @if($a->fecha_cita < now() && $a->estado != 'descartada')
                                                vencida <a href="/citas/{{$a->id}}/cancel" class="btn btn-danger" title="Rechazar">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                                            @else
                                                {{$a->estado}}
                                            @endif
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </table>
                            
                        @else
                            <p>No tienes ninguna cita para confirmar</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection