@extends('layouts.app2')

@section('content')
<script>
    function preview(that) {
        document.getElementById('imagen').src = window.URL.createObjectURL(that.files[0]);
        document.getElementById("imagen").removeAttribute('hidden');
    }
</script>

<div class="container">
        <br>
        <a href="/supports/" class="btn btn-primary"><i class="fa-solid fa-backward"></i> Regresar</a>
        <br>
    <div class="row align-items-start">
        <div class="col"><br>
            <div class="card">
                <h3 style="margin: 15px;">Enviar un ticket</h3>
                {!! Form::open(['action'=>'App\Http\Controllers\SupportsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group" style="margin: 15px;">
                        {{Form::label('asunto', 'Asunto')}}
                        {{Form::text('asunto', '', ['class' => 'form-control','placeholder'=>'Asunto'])}}
                    </div>
                    <div class="form-group" style="margin: 15px;">
                        {{Form::label('descripcion', 'Descripción')}}
                        <textarea class="form-control" placeholder="Describa aqui la razon de su ticket" id="descripcion"
                        name="descripcion" style="height: 200px"></textarea>
                    </div>
            </div>
        </div>
        <div class="col"><br>
            <div class="card">
                <h5 class="card-title" style="margin: 10px;">Si desea adjuntar alguna imagen o documento hagalo aqui (opcional):</h5>
                <div class="card-body">
                    <input type="file" name="foto" id="foto" 
                    onchange="preview(this);">
                </div>
                <div class="text-center">
                    <img id="imagen" width="400" height="250" style="margin: 10px;" hidden/>
                </div>
            </div>  
        </div>
    </div>
    <br>
    <div class="row align-items-start">
        <div class="col text-center">
                {{Form::hidden('user_id', Auth::user()->id )}}
                {{Form::submit('Enviar', ['class'=>'btn btn-primary btn-lg'])}}
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection