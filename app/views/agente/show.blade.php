@extends ('master.layout')
@section ('title') {{ $agente->nombre }} | App-Retenciones @stop
@section ('content')

   	<legend><h3>{{ $agente->nombre }}</h3></legend>
   	
	<blockquote>
	<dl class="dl-horizontal">
		<dt>Nombre:</dt>
		<dd>{{ $agente->nombre }}</dd>
		<dt>RIF:</dt>
		<dd>{{ $agente->rif }}</dd>
		<dt>Dirección:</dt>
		<dd>{{ $agente->direccion }}</dd>
		<dt>Teléfono:</dt>
		<dd>{{ $agente->tlf }}</dd>
		<dt>Secuencia IVA:</dt>
		<dd>{{ $agente->comp }}</dd>
		<dt>Secuencia ISLR:</dt>
		<dd>{{ $agente->compislr }}</dd>
	</dl>
	<small><strong>Creado el 
		<cite title="Source Title">
			{{ date("d/m/Y", strtotime($agente->created_at)) }}
			a las
			{{ date("H:i:s a", strtotime($agente->created_at)) }}
		</cite>
		 por 
		<cite>			
	    	{{ $user->username }}	           
		</cite>
		</strong>
	</small>
	<small><strong>Ultima actualización el 
		<cite title="Source Title">
			{{ date("d/m/Y", strtotime($agente->updated_at)) }}
			a las 
			{{ date("H:i:s a", strtotime($agente->updated_at)) }}
		</cite>
		 por 
		<cite>			
	        {{ $user->username }}	            
		</cite>
		</strong>
	</small>
	</blockquote>
     
@stop