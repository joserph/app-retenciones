@extends ('master.layout')
@section ('title') I.V.A. {{ $iva->iva }}% | App-Retenciones @stop
@section ('content')

   	<legend><h3><i class="fa fa-line-chart fa-fw"></i> I.V.A. {{ $iva->iva }}%</h3></legend>
   	
   	<ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li><a href="{{ route('iva.index') }}">Impuesto I.V.A.</a></li>
        <li class="active">I.V.A. {{ $iva->iva }}%</li>
    </ul>

	<blockquote>
	<dl class="dl-horizontal">
		<dt>I.V.A.:</dt>
		<dd>{{ $iva->iva }} %</dd>
		<dt>Estatus:</dt>
		<dd class="text-capitalize">{{ $iva->estatus }}</dd>
		<dt>Vigencia:</dt>
		<dd>{{ date("d/m/Y", strtotime($iva->vigencia)) }}</dd>
	</dl>
	<small><strong>Creado el 
		<cite title="Source Title">
			{{ date("d/m/Y", strtotime($iva->created_at)) }}
			a las
			{{ date("H:i:s a", strtotime($iva->created_at)) }}
		</cite>
		 por 
		<cite>			
	    	{{ $user->username }}	           
		</cite>
		</strong>
	</small>
	<small><strong>Ultima actualización el 
		<cite title="Source Title">
			{{ date("d/m/Y", strtotime($iva->updated_at)) }}
			a las 
			{{ date("H:i:s a", strtotime($iva->updated_at)) }}
		</cite>
		 por 
		<cite>			
	        {{ $user->username }}	            
		</cite>
		</strong>
	</small>
	</blockquote>
     
@stop