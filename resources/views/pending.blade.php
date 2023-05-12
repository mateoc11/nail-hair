@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verificacion') }}</div>
                <div class="card-body text-center">
                    @if(Auth::user()->active == 'pending')
                        <img src="error.png" style="width: 150px; height: 150px; float: center; border-radius: 40%;"></img>
                        <br><br>
                        <p>
                            Su cuenta esta en estado de verificacion, recuerde que el periodo estimado de verificacion
                            es de 24 a 48 horas habiles, si todos los datos brindandos son veridicos y coinciden entre si, su cuenta
                            sera habilitada sin ninguna dificultad para que pueda hacer uso de las funciones de nuestra web.
                                <br><br>
                                <b>Cordialmente, Nail&Hair</b>
                                <br><br>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  
                                class="btn btn-primary"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesion</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </p>
                   @endif
                   @if(Auth::user()->active == 'no')
                        <img src="error.png" style="width: 150px; height: 150px; float: center; border-radius: 40%;"></img>
                        <br><br>
                        <p>
                            Su cuenta no fue  o ha sido bloqueada en nuestro sitio web, debido a incongruencias en los datos 
                            suministrados, faltas a las politicas o malos comportamientos, pongase en contacto con soporte para apelar esta decision o tener mas detalles
                            del motivo de invalidación, lamentamos no poder tenerte con nosotros.
                                <br><br>
                                <b>Cordialmente, Nail&Hair</b>
                                <br><br>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  
                                class="btn btn-primary"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesion</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </p>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
