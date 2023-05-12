@extends('layouts.app2')

@section('content')

<div class="container">
        <br>
        <a href="/supports/" class="btn btn-primary"><i class="fa-solid fa-backward"></i> Regresar</a>
        <br>
    <div class="row align-items-start">
        <div class="col"><br>
            <div class="card">
                <h3 style="margin: 15px;display:inline-block;">Ticket #{{$ticket->id}}</h3>
                @if ($ticket->active == 'pending')
                    <p class="badge bg-warning" style="color:black;width:85px;margin-left: 15px;">Pendiente</p>
                @endif
                @if($ticket->active == 'resolved')
                    <p class="badge bg-success" style="width:85px;margin-left: 15px;">Respondido</p>
                @endif
                @if($ticket->active == 'finished')
                    <p class="badge bg-danger" style="width:85px;margin-left: 15px;">Finalizado</p>
                @endif
                <small style="margin-left: 15px;">Creado el {{$ticket->created_at}} por {{$ticket->user->username}}</small>
                    <div class="form-group" style="margin: 15px;">
                        <label style="color: #9f24d4;">Asunto:</label>
                        <p style="font-size: 20pt;"><b>{{$ticket->asunto}}</b></p>
                        <label style="color: #9f24d4;">Descripción:</label>
                        <p style="font-size: 14pt;width:100%;">{{$ticket->descripcion}}</p>
                        {!! Form::open(['action'=>['App\Http\Controllers\SupportsController@update', $ticket->id], 'method' => 'POST']) !!}
                        {{Form::hidden('_method','PUT')}}
                        {{Form::hidden('asesor', Auth::user()->username )}}
                        <label style="color: #9f24d4;font-size: 18pt;"><b>Responde la inquietud:</b></label>
                        <textarea class="form-control" placeholder="Responda aqui el PQRS del usuario" id="respuesta"
                        name="respuesta" style="height: 100px" required></textarea><br>
                        <p>Fue la inquietud del usuario entendible, valida y solucionada correctamente:</p>
                            <input class="form-check-input" type="radio" id="si" name="correct" value="si" required>
                            <label for="si">Si</label><br>
                            <input class="form-check-input"type="radio" id="no" name="correct" value="no">
                            <label for="no">No</label><br>
                        @if($ticket->asesor != NULL || $ticket->respuesta != NULL)
                            <label style="color: #9f24d4;"><b>Respuesta: </b></label>
                            <p style="font-size: 14pt;width:100%;">{{$ticket->respuesta}}</p>
                            <small>Respondido por el asesor: {{$ticket->asesor}}</small>
                        @endif
                        <br>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Responder
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Esta seguro de responder el ticket?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                {{Form::submit('Enviar', ['class'=>'btn btn-primary'])}}
                            </div>
                            </div>
                        </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
            </div>
        </div>
        @if($ticket->image != NULL)
            <div class="col"><br>
                <div class="card">
                    <h5 class="card-title" style="margin: 10px;">Imagen adjunta:</h5>
                    <div class="text-center">
                        <img id="imagen" src="/uploads/PQRS/{{$ticket->image}}" width="400" height="250" style="margin: 10px;"/>
                    </div>
                </div>  
            </div>
        @endif
    </div>
</div>
@endsection