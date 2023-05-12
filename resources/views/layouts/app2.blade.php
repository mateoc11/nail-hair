<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nail&Hair</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="{{ asset('css/dark-mode.css') }}" rel="stylesheet" type="text/css" >
  <script src="https://kit.fontawesome.com/8ec07cbd02.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
  <link rel="icon" href="{{ asset('nail.png') }}">
  @livewireStyles
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka&display=swap');
    .bg-pink{
        background: linear-gradient(90deg, rgba(185,96,236,1) 0%, rgba(185,96,236,1) 35%, rgba(96,127,236,1) 100%)  !important;
    }
    h3{
      color: #9f24d4;
      text-shadow: 1px 1px 2px black;
      font-family: 'Fredoka', sans-serif;
    }

    #right_curtain .carousel-inner img {
        object-fit: cover;
    }

    .darken{
      filter: brightness(50%);
    }
    .dark-mode .bg-light{
        background-color:  #343a40 !important;
    }
    

    .dark-mode .text-dark{
        color: #bebebe !important;
    }

    .dark-mode {
        color: #bebebe;
        background-color:  #343a40 ; /* #212121, #121212, #323232, #909090 */
    }
    .dark-mode td{
        color: #bebebe ;
    }
    .dark-mode th{
        color: #bebebe ;
    }

    .card{
      box-shadow: 0 5px 10px rgba(0,0,0,.2);
    }
    .dark-mode input[type="datetime-local"] { 
      color: #bebebe;
      background-color: #171717;
      border-color: #404040;
    } 
    .dark-mode input[type="datetime-local"]::-webkit-calendar-picker-indicator {
      filter: invert(100%);
    }

    .dark-mode .form-select{
      color: #bebebe;
      background-color: #171717;
      border-color: #404040;
    }

    .btn-primary{
      background-color: #b960ec;
      border: #b960ec;
    }
    .btn-primary:hover {
      background-color: #8141a6;
    }

</style>
<body>
<div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-pink">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">
            <img src="{{ asset('logo2.png') }}" alt="" width="40" height="34" class="d-inline-block align-text-top">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0" style="font-size: 15pt;">
              <li class="nav-item">
                <a class="nav-link active" href="/posts/"><i>Inicio</i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="/anuncios"><i>Anuncios</i></a>
              </li>
              @if (!Auth::guest())
                @if(Auth::user()->tipo == 'cliente')
                  <li class="nav-item">
                    <a class="nav-link active" href="/citas2"><i>Mis Citas</i></a>
                  </li>
                @endif
                @if(Auth::user()->tipo == 'asesor' || Auth::user()->tipo == 'admin' )
                  <li class="nav-item">
                    <a class="nav-link active" href="/validate"><i>Validar Usuarios</i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="/supports"><i>Responder PQRS</i></a>
                  </li>
                @endif
                @if(Auth::user()->tipo == 'trabajador')
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown">
                      <i>Mis Citas</i>
                    </a>
                    <ul class="dropdown-menu active">
                      <li><a class="dropdown-item" href="/citas">Citas para Confirmar</a></li>
                      <li><a class="dropdown-item" href="/citas2">Mis Citas Agendadas</a></li>
                    </ul>
                  </li>
                @endif
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown">
                    <i>Perfil</i>
                  </a>
                  <ul class="dropdown-menu active">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">Mi perfil</a></li>
                    @if(Auth::user()->tipo == 'trabajador')
                    <li><a class="dropdown-item" href="{{ route('home') }}">Administrar anuncios</a></li>
                    @endif
                  </ul>
                </li>
                @if(Auth::user()->tipo == 'admin')
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown">
                      <i>Administrador</i>
                    </a>
                    <ul class="dropdown-menu active">
                      <li><a class="dropdown-item" href="/admin/stats">Estadisticas</a></li>
                      <li><a class="dropdown-item" href="/admin/revision">Usuarios a Revisar</a></li>
                      <li><a class="dropdown-item" href="/admin/roles">Asignación de perfiles</a></li>
                    </ul>
                  </li>
                @endif
              @endif
            </ul>
                                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto active">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="position:relative;padding: left 50px;">
                                    Acceder
                                </a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Route::has('login'))
                                        <a class="dropdown-item" href="{{ route('login') }}">
                                            {{ __('Login') }}
                                        </a>
                                    @endif

                                    @if (Route::has('register'))
                                        <a class="dropdown-item" href="{{ route('register') }}">
                                            {{ __('Register') }}
                                        </a>
                                    @endif
                                    <div class="dropdown-item">
                                        <div class="form-check form-switch"> 
                                            <input class="form-check-input" type="checkbox" id="darkMode">
                                            <label class="form-check-label" for="darkMode">Modo oscuro</label>
                                        </div>
                                    </div>

                                </div>

                            </li>

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="position:relative;padding: left 50px;">
                                    <img src="/uploads/avatars/{{Auth::user() -> avatar}}" style="width: 32px;height: 32px;top: 10px;border-radius:49%;">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-item">
                                        <div class="form-check form-switch"> 
                                            <input class="form-check-input" type="checkbox" id="darkMode">
                                            <label class="form-check-label" for="darkMode">Modo oscuro</label>
                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                </ul>

          </div>
        </div>
  </nav>
    <main>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              Por favor desactiva tu bloqueador de anuncios
            </h5>
          </div>
          <div class="modal-body">
            La pagina de Nail&Hair aunque enfocada de manera social a ayudar a las personas, necesita
            de recursos para mantenerse en linea optimamente, esto lo hacemos mediante anuncios y publicidad.<br>
            <br>
            Por esta razon no podras hacer uso de la pagina web a menos que desactives el bloqueador de anuncios.
            <br><br>

            Disculpa las molestias causadas.
            <br><br>
            <div class="text-center">
              <img src="{{ asset('adblock.gif') }}" alt="Apagar adblock"/>
            </div>
          </div>
          <div class="modal-footer">
            Nail&Hair
          </div>
        </div>
      </div>
    </div>
          @include('inc.messages')
          @yield('content')
    </main>
    <a href="/supports"><button type="button" class="btn btn-info p-3 rounded-circle btn-sm" style="position: fixed;bottom: 0;right: 0;
    margin: 25px; background-color: #b960ec; border: none;box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
    <i class="fa-solid fa-headset fa-3x"></i></button></a>
    <br>
    <footer class="bg-light text-center text-lg-start">
    <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2022 Copyright:
            <a>Mateo Cifuentes Gomez - Diego Andres Cardenas</a>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        <a href="https://www.flaticon.com/free-icons/salon" title="salon icons" class="text-dark">Salon icons created by Freepik - Flaticon</a><br>
        <a href="https://www.flaticon.com/free-icons/hair" title="hair icons" class="text-dark">Hair icons created by Freepik - Flaticon</a>
        </div>
        <!-- Copyright -->
    </footer>
</div>



<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>-->
<script>
      // https://raw.githubusercontent.com/halfmoonui/halfmoon/master/js/halfmoon.js
      let darkModeOn = false;
        
      const createCookie = (name, value, days) => {
        let expires;
        if (days) {
          let date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "expires=" + date.toGMTString();
        } else {
          expires = "";
        }
        document.cookie = name + "=" + value + "; SameSite=Lax;"+ expires + "; path=/";
      }
        
      const readCookie = name => {
        let nameEQ = name + "=";
        let ca = document.cookie.split(";");
        for(let i=0; i < ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) === " ") {
            c = c.substring(1, c.length);
          }
          if (c.indexOf(nameEQ) === 0) {
            return c.substring(nameEQ.length,c.length);
          }
        }
        return null;
      }
        
      const deleteCookie = name => {
        createCookie(name, "", -1);
      }
        
      const toggleDarkMode = (e) => {
        if (document.body.classList.contains("dark-mode")) {
          document.body.classList.remove("dark-mode");
          darkModeOn = false;
          createCookie("my_preferredMode", "light-mode", 365);
        } else {
          document.body.classList.add("dark-mode");
          darkModeOn = true;
          createCookie("my_preferredMode", "dark-mode", 365);
        }
      }
        
      const getPreferredMode = () => {
        if (readCookie("my_preferredMode")) {
          return readCookie("my_preferredMode");
        } else {
          return "not-set";
        }
      }
        
      document.getElementById("darkMode").addEventListener("click", toggleDarkMode)
        
      document.addEventListener("DOMContentLoaded", () => {
        if (readCookie("my_preferredMode")) {
          if (readCookie("my_preferredMode") == "dark-mode") {
            darkModeOn = true;
          } else {
            darkModeOn = false;
          }
        } else {
          if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
            darkModeOn = true;
          } else {
            if (document.body.classList.contains("dark-mode")) {
              darkModeOn = true;
            } else {
              darkModeOn = false;
            }
          }
        }
  
        if (darkModeOn) {
          if (!document.body.classList.contains("dark-mode")) {
            document.body.classList.add("dark-mode");
          }
          document.getElementById("darkMode").checked = true
        } else {
          if (document.body.classList.contains("dark-mode")) {
            document.body.classList.remove("dark-mode");
          }
        }
      })

      async function detectAdBlock() {

        let adBlockEnabled = false
        const googleAdUrl = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'
        try {
          await fetch(new Request(googleAdUrl)).catch(_ => adBlockEnabled = true)
        } catch (e) {
          adBlockEnabled = true
        } finally {
          console.log(`AdBlock Enabled: ${adBlockEnabled}`)
          if(adBlockEnabled===true){
            $('#staticBackdrop').modal('show');
          }
        }
      }
      $(window).on('load', function() {
        detectAdBlock();
      });

</script>
@livewireScripts
</body>
</html>