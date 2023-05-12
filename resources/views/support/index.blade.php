@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/posts/" class="btn btn-primary"><i class="fa-solid fa-backward"></i> Regresar</a>
            <br><br>
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">
                        <h4 style="color: #b960eb;text-decoration: none;">Bienvenido a nuestra sección de PQRS</h4>
                        Aqui pueder enviar cualquier inquietud que tengas y nuestros empleados estaran felices de atenderte
                    </li>
                </ul>
                <div class="card-body">
                    <p>¿Tienes algo que decirnos?, crea un nuevo ticket en el boton de abajo para enviar tu inquietud:</p>
                    <div class="text-center"><a href="/supports/create" class="btn btn-primary btn-lg"><i class="fa-solid fa-headset"></i> Crear un ticket</a></div><br>
                    <h4>Tus tickets enviados: </h4>
                    <table class="table table-striped">
                    <colgroup>
                        <col span="1" style="width: 10%;">
                        <col span="1" style="width: 45%;">
                        <col span="1" style="width: 50%;">
                    </colgroup>
                        <tr>

                        </tr>
                    @if(count($tickets)>0)
                        @foreach($tickets as $ticket)
                        <tr>
                            <td><i class="fa-solid fa-circle-info fa-3x"></i></td>
                            <td></i> {{$ticket -> asunto}}
                            @if ($ticket->active == 'pending')
                                <span class="badge bg-warning" style="color: black;">Pendiente</span>
                            @endif
                            @if($ticket->active == 'resolved')
                                <span class="badge bg-success">Respondido</span>
                            @endif
                            @if($ticket->active == 'finished')
                                <span class="badge bg-danger">Finalizado</span>
                            @endif
                            <br>
                            <small>Creado hace
                                @php(($date = \Carbon\Carbon::parse($ticket->created_at)->diffInDays()))
                                @if($date>0)
                                    {{($ticket->created_at)->diffInDays()}} dias
                                @elseif(($ticket->created_at)->diffInHours()>0)
                                    {{($ticket->created_at)->diffInHours()}} horas
                                @else
                                    {{($ticket->created_at)->diffInMinutes()}} minutos
                                @endif
                            </small></td>
                            <td><a href="/supports/{{$ticket->id}}" class="btn btn-success btn-sm"><i class="fa-solid fa-eye"></i> Ver ticket</a></td>
                        </tr>
                        @endforeach
                        </table>
                    @else
                        <p>No tienes ningun ticket creado</p>
                    @endif
                </div>
                </div>
                <br>

            </div>
        </div>
    </div>
</div>
<br>
@endsection('content')