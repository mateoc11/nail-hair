
<div>
<br>
    <input wire:model="inactive" class="form-check-input" 
    type="checkbox" value="1" style="margin-left: 25px;">
    <label class="form-check-label" for="flexCheckDefault">
        Mostrar usuarios desactivados/pendientes
    </label><br>
    <input wire:model="badReviews" class="form-check-input" 
    type="checkbox" value="1" style="margin-left: 25px;">
    <label class="form-check-label" for="flexCheckDefault">
        Solo usuarios con malas calificaciones
    </label><br>
    <input wire:model="search" type="text" class="form-control" placeholder="&#xF002; Buscar por usuario" 
    style="font-family:Arial, FontAwesome;margin-left:25px;width:50%" />
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Usuarios a revisar con malas calificaciones por parte de los usuarios') }}</div>
                <div class="card-body table-responsive">
                    <h2>Usuarios</h2>
                    @if(count($users) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Calificación</th>
                                <th>Detalle</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td><a href="/profiles/{{$user->id}}" style="text-decoration: none;">{{$user->username}}</a>
                                    @if($user->active == 'pending')
                                        <i class="fa-solid fa-clock" style="color: gold;"  title="Pendiente"></i>
                                    @elseif($user->active == 'yes' )
                                        <i class="fa-solid fa-check" style="color: limegreen;" title="Activo"></i>
                                    @elseif($user->active == 'no')
                                        <i class="fa-solid fa-lock" style="color: orangered;" title="Desactivado"></i>
                                    @endif</td>
                                    <td>{{$user->email}}</td>
                                    <td><i class="fas fa-star fa-lg" style="color: gold;"></i>
                                    @if($user->rating !=0 )
                                        {{$user->rating}}
                                    @else
                                        Sin Reviews
                                    @endif</td>
                                    <td><a href="/admin/user/{{$user->id}}" class="btn btn-primary" title="Ver mas...">
                                    <i class="fa-solid fa-bars" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>No se encontraron usuarios</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br>