@extends('layouts.app2')

@section('content')
<script>
    function yesnoCheck(that) {
    if (that.value == "trabajador") {
        document.getElementById("ifYes").style.display = "block";
        document.getElementById("foto").setAttribute('required', '');
        document.getElementById("cedula").setAttribute('required', '');
    } else {
        document.getElementById("ifYes").style.display = "none";
        document.getElementById("foto").removeAttribute('required');
        document.getElementById("cedula").removeAttribute('required');
    }
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br>
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">Usuario</label>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                        </div>

                        <div class="row mb-3">
                                <label for="cel" class="col-md-4 col-form-label text-md-end">Celular/Whatsapp</label>
                                <div class="col-md-6">
                                    <input id="username" type="number" min=0 max=9999999999 class="form-control @error('cel') is-invalid @enderror" name="cel" value="{{ old('cel') }}" required>
                                        @error('cel')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electronico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">Tipo</label>
                                <div class="col-md-6">
                                    <select id="tipo" class="form-select @error('tipo') is-invalid @enderror" id="inputGroupSelect01" name="tipo" value="{{ old('tipo') }}" onchange="yesnoCheck(this);" required>
                                            
                                            <option value="cliente">cliente</option>
                                            <option value="trabajador">trabajador</option>

                                    </select>
                                        @error('tipo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                        </div>

                        <div id="ifYes" style="display: none;">
                            
                            <div class="row mb-3">
                                <label for="foto" class="col-md-4 col-form-label text-md-end">{{ __('Foto de Perfil (Obligatorio)') }}</label>

                                <div class="col-md-6">
                                <input class="form-control @error('password') is-invalid @enderror" type="file" id="foto" name="foto">

                                    @error('foto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cedula" class="col-md-4 col-form-label text-md-end">{{ __('Cedula por ambos lados (Obligatorio)') }}</label>

                                <div class="col-md-6">
                                <input class="form-control @error('cedula') is-invalid @enderror" type="file" id="cedula" name="cedula">

                                    @error('cedula')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
