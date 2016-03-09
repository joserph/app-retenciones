@extends ('master.layout')
@section ('content')

  
  	<legend><h3><i class="fa fa-dashboard fa-fw"></i> Perfil de {{ $user->username }}</h3></legend>

  	<ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Perfil de {{ $user->username }}</li>
    </ul>
    
    <div class="row">
        <div class="text-center col-md-6 col-md-offset-3">
            @if($user->sexo == 'Hombre')  
                {{ HTML::image('assets/img/h.png', 'profile', array('class' => 'img-responsive img-circle profile', 'width' => '100')) }}
            @elseif($user->sexo == 'Mujer')
                <p>{{ HTML::image('assets/img/m.png', 'profile', array('class' => 'img-responsive img-circle profile', 'width' => '100')) }}</p>
            @endif        
            <h3>{{ $user->nombre }}</h3>
                <p><i class="fa fa-user fa-fw"></i> {{ $user->username }}</p>
            @if($user->id_rol == 0)
                <p><i class="fa fa-cog fa-fw"></i> Administrador</p>
            @elseif($user->id_rol == 1)
                <p><i class="fa fa-cog fa-fw"></i> Editor</p>
            @else 
                <p><i class="fa fa-cog fa-fw"></i> Usuario</p>
            @endif
            <p><i class="fa fa-envelope fa-fw"></i> {{ $user->email }}</p>
            <p><i class="fa fa-map-marker fa-fw"></i> {{ $user->ubicacion }}</p>
            <p><i class="fa fa-star fa-fw"></i> Registrado el <cite title="Source Title">{{ date("d/m/Y H:i:s a", strtotime($user->created_at)) }}.</cite></p>
            <p><a href="{{ route('profile.edit', $user->id) }}" class="btn btn-warning btn-block "><i class="fa fa-edit fa-fw"></i> Editar</a></p>
        </div>        
    </div> 
@stop