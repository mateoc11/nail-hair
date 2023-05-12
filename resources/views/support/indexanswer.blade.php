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
                        <h4 style="color: #b960eb;text-decoration: none;">Tickets de PQRS pendientes de respuesta</h4>
                        Aqui responderas las dudas e inquietudes de los usuarios con el fin de garantizar una excelente atencion al cliente
                    </li>
                </ul>
                <div class="card-body">
                    <h4>Tickets de los usuarios: </h4>
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
                                por {{$ticket->user->name}}
                            </small></td>
                            <td><a href="/supports/{{$ticket->id}}" class="btn btn-success btn-sm"><i class="fa-solid fa-eye"></i> Responder ticket</a></td>
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