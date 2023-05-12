@extends('layouts.app2')

@section('content')

<div class="container">
        <br>
        <a href="/supports/" class="btn btn-primary"><i class="fa-solid fa-backward"></i> Regresar</a>
        <br>
    <div class="row align-items-start">
        <div class="col"><br>
            <div class="card">
                <h3 style="margin: 15px;display:inline-block;">Tu Ticket: #{{$ticket->id}}</h3>
                @if ($ticket->active == 'pending')
                    <p class="badge bg-warning" style="color:black;width:85px;margin-left: 15px;">Pendiente</p>
                @endif
                @if($ticket->active == 'resolved')
                    <p class="badge bg-success" style="width:85px;margin-left: 15px;">Respondido</p>
                @endif
                @if($ticket->active == 'finished')
                    <p class="badge bg-danger" style="width:85px;margin-left: 15px;">Finalizado</p>
                @endif
                <small style="margin-left: 15px;">Creado el {{$ticket->created_at}}</small>
                    <div class="form-group" style="margin: 15px;">
                        <label style="color: #9f24d4;">Asunto:</label>
                        <p style="font-size: 20pt;"><b>{{$ticket->asunto}}</b></p>
                        <label style="color: #9f24d4;">Descripción:</label>
                        <p style="font-size: 14pt;width:100%;">{{$ticket->descripcion}}</p>
                        @if($ticket->asesor != NULL || $ticket->respuesta != NULL)
                            <label style="color: #9f24d4;"><b>Respuesta: </b></label>
                            <p style="font-size: 14pt;width:100%;">{{$ticket->respuesta}}</p>
                            <small>Respondido por el asesor: {{$asesor[0]->name}}
                            hace
                                @php(($date = \Carbon\Carbon::parse($ticket->updated_at)->diffInDays()))
                                @if($date>0)
                                    {{($ticket->updated_at)->diffInDays()}} dias
                                @elseif(($ticket->updated_at)->diffInHours()>0)
                                    {{($ticket->updated_at)->diffInHours()}} horas
                                @else
                                    {{($ticket->updated_at)->diffInMinutes()}} minutos
                                @endif
                            </small
                        @endif
                    </div>
            </div>
        </div>
        @if($ticket->image != NULL)
            <div class="col"><br>
                <div class="card">
                    <h5 class="card-title" style="margin: 10px;">Imagen adjunta:</h5>
                    <div class="text-center table-responsive">
                        <img id="imagen" src="/uploads/PQRS/{{$ticket->image}}" width="400" height="250" style="margin: 10px;"/>
                    </div>
                </div>  
            </div>
        @endif
    </div>
    <br>
    <div class="row align-items-start">
    </div>
</div>
@endsection