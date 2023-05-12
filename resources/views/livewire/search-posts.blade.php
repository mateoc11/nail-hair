<div>
  @if (!Auth::guest())
    @if(Auth::user()->tipo == 'admin')
    <input wire:model="unactive" class="form-check-input" 
    type="checkbox" value="1" style="margin-left: 25px;">
    <label class="form-check-label" for="flexCheckDefault">
        Mostrar solo anuncios desactivados
    </label><br>
    @endif
  @endif  
  <div class="row" style="width:100%">
    <div class="col" style="margin-left: 15px;">
         <input wire:model="search" type="text" class="form-control" placeholder="&#xF002; Buscar por titulo" 
         style="font-family:Arial, FontAwesome;" />
    </div>
    <div class="col">
            <select wire:model="selectedStatus" class="form-select" >
                <option value="">Fecha</option>
                <option value="4">Hoy</option>
                <option value="1">Ultima Semana</option>
                <option value="3">Ultimos 15 dias</option>
                <option value="2">Ultimo Mes</option>
            </select>
    </div>
    <div class="col" style="margin-right: 0px;">
            <select wire:model="selectedOrder" class="form-select" >
                <option value="4">Ordenar Por:</option>
                <option value="1">Mas Antiguos primero</option>
                <option value="2">Mas Nuevos primero</option>
                <option value="3">Mas likes primero</option>
            </select>
    </div>
  </div>
  <hr>
  <div class="py-5">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
       @if(count($posts) >= 1)
            @foreach($posts as $post)
            @php
              list($width, $height) = getimagesize(public_path('/uploads/banners/'.$post->banner1));
              if ($width > $height) {
                  $orientation = "landscape";
              } else {
                  $orientation = "portrait";
              }
            @endphp
            <div class="col">
                <div class="card shadow-sm">
                  @if($orientation == 'landscape')
                    <img src="/uploads/banners/{{$post -> banner1}}" class="card-img-top" width="100%" height="225" preserveAspectRatio="xMidYMid slice" focusable="false">
                  @elseif($orientation == 'portrait') 
                  <div class="text-center">
                    <img src="/uploads/banners/{{$post -> banner1}}" class="img-responsive" width="150" height="225" preserveAspectRatio="xMidYMid slice" focusable="false">
                  </div>
                  @endif
                    @if (!Auth::guest())
                      @if(Auth::user()->tipo == 'admin')
                         @if($post->active=='no')<small class="text-center" style="color: red;">inactivo</small> @else<small class="text-center" style="color: limegreen;">activo</small> @endif
                      @endif
                    @endif  
                    <div class="card-body">
                    <h5 class="card-title"><a href="/posts/{{$post->id}}" style="color: #b960eb;text-decoration: none;">{{ $post->title }}</a></h5>
                    <p class="card-text">{{$post->body}}</p>
                    <small>Creado hace
                      @php(($date = \Carbon\Carbon::parse($post->created_at)->diffInDays()))
                      @if($date>0)
                         {{($post->created_at)->diffInDays()}} dias
                      @elseif(($post->created_at)->diffInHours()>0)
                         {{($post->created_at)->diffInHours()}} horas
                      @else
                         {{($post->created_at)->diffInMinutes()}} minutos
                      @endif
                    </small>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                        @if(!Auth::guest())
                          @if(Auth::user()->id == $post -> user_id || Auth::user()->tipo == 'admin')
                          <a href="/posts/{{$post -> id}}/edit" class="btn btn-sm btn-outline-secondary">Editar</a>
                          @endif
                        @endif
                        </div>
                        
                        <small class="text-muted"><img src="/uploads/avatars/{{$post->user->avatar}}" style="width: 32px;height: 32px;top: 10px;border-radius:20%;">{{$post->user->name}}</small>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p>No se encontraron anuncios</p>
        @endif
    </div><br>
    @if(count($posts) >= 1)
    <div class="container d-flex align-items-center justify-content-center">{{$posts->links()}}</div>
    @endif
  </div>
</div>
