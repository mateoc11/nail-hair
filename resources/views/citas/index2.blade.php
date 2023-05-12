@extends('layouts.app2')

@section('content')  
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-16"><br>
                <div class="card">
                    <div class="card-header">{{ __('Mis citas') }}</div>
                    <div class="card-body table-responsive">
                        <h2>Mis Citas Agendadas</h2>
                        @if(count($citas) > 0)
                            <table class="table table-striped table-bordered  border-5">
                                <tr>
                                    <th>Fecha y Hora</th>
                                    <th>del Anuncio</th>
                                    <th>Trabajador: </th>
                                    <th>Estado: </th>
                                </tr>
                            @foreach($citas as $cita)
                                    <tr style="background-color: @if($cita->estado == 'pendiente') #f2f794 
                                    @elseif($cita->estado == 'confirmada') #93f595 
                                    @elseif($cita->estado == 'rechazada' || $cita->estado == 'descartada' || $cita->estado == 'cancelada' )  #f26f6f
                                    @endif;color:black;">
                                        <td style="color: black;">{{$cita -> fecha_cita}} en {{$cita -> ubicacion}}</td>
                                        <td><a href="/posts/{{$cita->post->id}}" style="color: black;">{{$cita -> post->title}}</a></td>
                                        <td style="color: black;"><img src="/uploads/avatars/{{$cita->post->user->avatar}}" style="width: 35px;height: 35px;top: 10px;border-radius:20%;margin: 5px;">
                                        <a href="/profiles/{{$cita->post->user->id}}" style="text-decoration: none;">{{$cita->post->user->name}}</a></td>
                                        <td style="color: black;">
                                            @if($cita->estado == 'confirmada')
                                                {{$cita->estado}}<br><a href="/citas/{{$cita->id}}/usercancel" class="btn btn-danger" title="Cancelar">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a> <a href="https://wa.me/57{{$cita->post->user->cel}}" class="btn btn-success" title="Ponte en contacto con el trabajador!">
                                                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
                                            @elseif($cita->estado == 'descartada')
                                                Descartada
                                            @elseif($cita->estado == 'cancelada')
                                                {{$cita->estado}}
                                            @elseif($cita->fecha_cita < now())
                                                Vencida
                                            @else 
                                                {{$cita->estado}}<br><a href="/citas/{{$cita->id}}/usercancel" class="btn btn-danger" title="Cancelar">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                            @endforeach
                            </table>
                        @else
                            <p>No tienes ninguna cita agendada</p>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection