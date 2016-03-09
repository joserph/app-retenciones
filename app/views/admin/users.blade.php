@extends('master.layout')
@section ('title') Usuarios registrados | App-Retenciones @stop
@section('content')
	
	<legend><h3><i class="fa fa-users fa-fw"></i> Usuarios registrados</h3></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li><a href="{{ URL::route('admin') }}">Administración de usuarios</a></li>
        <li class="active">Usuarios registrados</li>
    </ul>
	
	<div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
		    <tr>
		    	<th>#</th>
		        <th>Nombre</th>
		        <th>Username</th>  
		        <th>Email</th>
		        <th>Rol</th>
		        <th>Ubicación</th>  
		        <th>Fecha de registro</th>
		    </tr>
		    @foreach ($users as $user)
			    <tr>
			    	<td>{{ $contador += 1 }}</td>
			        <td>{{ $user->nombre }}</td>
			        <td>{{ $user->username }}</td>
			        <td>{{ $user->email }}</td>
			        <td>@if($user->id_rol == 0)
                			Administrador
			            @elseif($user->id_rol == 1)
			                Editor
			            @else 
			                Usuario
			            @endif
			        </td>
			        <td>{{ $user->ubicacion }}</td>
			        <td>{{ date("d/m/Y H:i:s a", strtotime($user->created_at)) }}</td>
				</tr>
	    	@endforeach
  		</table>
  	</div>	
@stop