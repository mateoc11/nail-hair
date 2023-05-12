<div>
    <h2 style="margin-left:10px;">Asignación de roles</h2>
  <div class="row" style="width:100%">
    <div class="col" style="margin-left: 15px;">
         <input wire:model="search" type="text" class="form-control" placeholder="&#xF002; Buscar por email" 
         style="font-family:Arial, FontAwesome;" />
    </div>
  </div><br>
  <div class="text-center"><i class="fa-solid fa-square" style="color: green;"></i> Activo 
  <i class="fa-solid fa-square" style="color: red;"></i> Inactivo
  <i class="fa-solid fa-square" style="color: gold;"></i> Pendiente</div>
  <hr>
  <div class="py-5">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
       @if(count($users) >= 1)
            @foreach($users as $user)
            <div class="col-sm-3">
                <div class="card shadow-sm">
                    <img src="/uploads/avatars/{{$user->avatar}}" class="card-img-top h-100" width="100%" height="225" preserveAspectRatio="xMidYMid slice" focusable="false">
                    @if($user->active == 'yes')
                        <span class="badge bg-success">{{$user->tipo}}</span>
                    @elseif($user->active == 'no')
                        <span class="badge bg-danger">{{$user->tipo}}</span>
                    @else
                        <span class="badge bg-warning">{{$user->tipo}}</span>
                    @endif
                    <div class="card-body">
                    <h5 class="card-title"><a href="" 
                    data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}"
                    style="text-decoration: none;">
                    {{ $user->name }}</a></h5>
                    <p class="card-text">{{$user->email}}</p>
                    <small>Creado hace
                      @php(($date = \Carbon\Carbon::parse($user->created_at)->diffInDays()))
                      @if($date>0)
                         {{($user->created_at)->diffInDays()}} dias
                      @elseif(($user->created_at)->diffInHours()>0)
                         {{($user->created_at)->diffInHours()}} horas
                      @else
                         {{($user->created_at)->diffInMinutes()}} minutos
                      @endif
                    </small>
                    <div class="d-flex justify-content-between align-items-center">
                        <!--<div class="btn-group">
                        @if(!Auth::guest())
                          @if(Auth::user()->id == $user -> user_id)
                          <a href="/posts/{{$user -> id}}/edit" class="btn btn-sm btn-outline-secondary">Editar</a>
                          @endif
                        @endif
                        </div>-->
                        
                        <small class="text-muted">{{$user->username}}</small>
                    </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$user->name}}<br>({{$user->email}})</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        Cambiar el rol de este usuario:<br><br>
                        {!!Form::open(['action' => ['App\Http\Controllers\AdminController@roleupdate'] , 'method' => 'POST'])!!}
                            {{Form::hidden('user_id', $user->id)}}
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rol" id="trabajador" value="trabajador"
                                @if($user->tipo=='trabajador') checked @endif>
                                <label class="form-check-label" for="trabajador">
                                    Trabajador
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rol" id="cliente" value="cliente"
                                @if($user->tipo=='cliente') checked @endif>
                                <label class="form-check-label" for="cliente">
                                    Cliente
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rol" id="asesor" value="asesor"
                                @if($user->tipo=='asesor') checked @endif>
                                <label class="form-check-label" for="asesor">
                                    Asesor
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rol" id="administrador" value="admin"
                                @if($user->tipo=='admin') checked @endif>
                                <label class="form-check-label" for="administrador">
                                    Administrador
                                </label>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                {{Form::submit('Guardar Cambios', ['class' => 'btn btn-primary'])}}
                            {!!Form::close()!!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p>No se encontraron usuarios</p>
        @endif
    </div><br>
    </div>
</div>
