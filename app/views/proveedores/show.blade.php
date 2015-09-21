@extends ('master.layout')
@section ('title') {{ $proveedores->nombre }} | App-Retenciones @stop
@section ('content')

   	<legend><h3>{{ $proveedores->nombre }}</h3></legend>
   	<ul class="breadcrumb">
	  	<li><a href="{{ URL::route('home') }}">Inicio</a></li>
	  	<li><a href="{{ route('proveedores.index') }}">Lista de Proveedores I.V.A.</a></li>
	  	<li class="active">{{ $proveedores->nombre }}</li>
	</ul>
	<blockquote>
	<dl class="dl-horizontal">
		<dt>Nombre:</dt>
		<dd>{{ $proveedores->nombre }}</dd>
		<dt>RIF:</dt>
		<dd>{{ $proveedores->rif }}</dd>
		<dt>Dirección:</dt>
		<dd>{{ $proveedores->direccion }}</dd>
		<dt>Porcentaje de retención:</dt>
		<dd>{{ $proveedores->porcentaje }}%</dd>
	</dl>
	<small><strong>Creado el 
		<cite title="Source Title">
			{{ date("d/m/Y", strtotime($proveedores->created_at)) }}
			a las
			{{ date("H:i:s a", strtotime($proveedores->created_at)) }}
		</cite>
		 por 
		<cite>			
	    	{{ $user->username }}	           
		</cite>
		</strong>
	</small>
	<small><strong>Ultima actualización el 
		<cite title="Source Title">
			{{ date("d/m/Y", strtotime($proveedores->updated_at)) }}
			a las 
			{{ date("H:i:s a", strtotime($proveedores->updated_at)) }}
		</cite>
		 por 
		<cite>			
	        {{ $user->username }}	            
		</cite>
		</strong>
	</small>
	</blockquote>
     
@stop