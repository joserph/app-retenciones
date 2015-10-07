@extends ('master.layout')
@section ('title') {{ $empleados->nombre }} | App-Retenciones @stop
@section ('content')

   	<legend><h3>{{ $empleados->nombre }}</h3></legend>
   	<ul class="breadcrumb">
	  	<li><a href="{{ URL::route('home') }}">Inicio</a></li>
	  	<li><a href="{{ route('empleados.index') }}">Lista de Empleados y Proveedores I.S.L.R.</a></li>
	  	<li class="active">{{ $empleados->nombre }}</li>
	</ul>
   	@if($empleados->tipo == 'empleado')
	<blockquote>
	<dl class="dl-horizontal">
		<dt>Nombre:</dt>
		<dd>{{ $empleados->nombre }}</dd>
		<dt>RIF:</dt>
		<dd>{{ $empleados->rif }}</dd>
		<dt>Dirección:</dt>
		<dd>{{ $empleados->direccion }}</dd>
		<dt>TLF:</dt>
		<dd>{{ $empleados->tlf }}</dd>
		<dt>Porcentaje:</dt>
		<dd>{{ $empleados->porcentaje }}%</dd>
		<dt>tipo:</dt>
		<dd class="text-capitalize">{{ $empleados->tipo }}</dd>
	</dl>
	<small><strong>Creado el 
		<cite title="Source Title">
			{{ date("d/m/Y H:i:s a", strtotime($empleados->created_at)) }}
		</cite>
		 por 
		<cite>			
	        {{ $user->username }}	            
		</cite>
		</strong>
	</small>
	<small><strong>Ultima actualización el 
		<cite title="Source Title">
			{{ date("d/m/Y H:i:s a", strtotime($empleados->updated_at)) }}
		</cite>
		 por 
		<cite>			
	        {{ $user->username }}	            
		</cite>
		</strong>
	</small>
	</blockquote>
	@else 
	<blockquote>
	<dl class="dl-horizontal">
		<dt>Nombre:</dt>
		<dd>{{ $empleados->nombre }}</dd>
		<dt>RIF:</dt>
		<dd>{{ $empleados->rif }}</dd>
		<dt>Dirección:</dt>
		<dd>{{ $empleados->direccion }}</dd>
		<dt>TLF:</dt>
		<dd>{{ $empleados->tlf }}</dd>
		<dt>Porcentaje:</dt>
		<dd>{{ $empleados->porcentaje }}%</dd>
		<dt>tipo:</dt>
		<dd class="text-capitalize">{{ $empleados->tipo }}</dd>
	</dl>
	<small><strong>Creado el 
		<cite title="Source Title">
			{{ date("d/m/Y H:i:s a", strtotime($empleados->created_at)) }}
		</cite>
		 por 
		<cite>			
	        {{ $user->username }}	            
		</cite>
		</strong>
	</small>
	<small><strong>Ultima actualización el 
		<cite title="Source Title">
			{{ date("d/m/Y H:i:s a", strtotime($empleados->updated_at)) }}
		</cite>
		 por 
		<cite>			
	        {{ $user->username }}	            
		</cite>
		</strong>
	</small>
	</blockquote>
	@endif
    @if(Auth::check())
    	<a href="{{ route('empleados.edit', $empleados->id) }}" class="col-xs-6 col-sm-6 btn btn-warning"><i class="fa fa-edit fa-fw"></i> Editar</a>
    @endif
@stop