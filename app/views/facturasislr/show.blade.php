@extends ('master.layout')
@section ('title')
	@if($facturasislr->tipo == 'proveedor')
		Nº Comprobante: {{ $facturasislr->n_factura }} | App-Retenciones
	@else
		Pago a {{ $proveedor->nombre }} el {{ date("d/m/Y", strtotime($facturasislr->fecha_fac)) }} | App-Retenciones
	@endif
@stop
@section ('content')
	@if($facturasislr->tipo == 'proveedor')
	   	<legend>
	   		<h3>Factura {{ $facturasislr->n_factura }}</h3>
	   	</legend>
	   	<ul class="breadcrumb">
		    <li><a href="{{ URL::route('home') }}">Inicio</a></li>
		    <li><a href="{{ route('facturasislr.index') }}">Lista de Factuas y Sueldos ISLR</a></li>
		    <li class="active">Factura {{ $facturasislr->n_factura }}</li>
	  	</ul>
		<blockquote>
		<dl class="dl-horizontal">
			<dt>Retención:</dt>			
	        <dd>{{ $reportesislr->n_comp }}</dd>	          
			<dt>Fecha:</dt>
			<dd>{{ date("d/m/Y", strtotime($facturasislr->fecha_fac)) }}</dd>
			<dt>N° Factura:</dt>
			<dd>{{ $facturasislr->n_factura }}</dd>
			<dt>N° Control:</dt>
			<dd>{{ $facturasislr->n_control }}</dd>
			<dt>Total:</dt>
			<dd>{{ number_format($facturasislr->total_compra,2,",",".") }}</dd>
			<dt>Base Imponible:</dt>
			<dd>{{ number_format($facturasislr->base_imp,2,",",".") }}</dd>
			<dt>% Retenido:</dt>
			<dd>{{ number_format($facturasislr->iva,2,",",".") }}</dd>
			<dt>Impuesto Retenido:</dt>
			<dd>{{ number_format($facturasislr->impuesto_iva,2,",",".") }}</dd>
		</dl>
		<small><strong>Creado el 
			<cite title="Source Title">
				{{ date("d/m/Y H:i:s a", strtotime($facturasislr->created_at)) }}
			</cite>
			 por 
			<cite>			
		        {{ $user->username }}	            
			</cite>
			</strong>
		</small>
		<small><strong>Ultima actualización el 
			<cite title="Source Title">
				{{ date("d/m/Y H:i:s a", strtotime($facturasislr->updated_at)) }}
			</cite>
			 por 
			<cite>			
		        {{ $user->username }}	            
			</cite>
			</strong>
		</small>
		</blockquote>
    @else 
	    <legend>
	    	<h3>Pago a {{ $proveedor->nombre }} el {{ date("d/m/Y", strtotime($facturasislr->fecha_fac)) }}</h3>
		</legend>
	   	<ul class="breadcrumb">
		    <li><a href="{{ URL::route('home') }}">Inicio</a></li>
		    <li><a href="{{ route('facturasislr.index') }}">Lista de sueldos y factuas I.S.L.R.</a></li>
		    <li class="active">Pago a {{ $proveedor->nombre }} el {{ date("d/m/Y", strtotime($facturasislr->fecha_fac)) }}</li>
	  	</ul>
		<blockquote>
		<dl class="dl-horizontal">
			<dt>Nº Comprobante:</dt>		
	        <dd>{{ $reportesislr->n_comp }}</dd>            
			<dt>Fecha:</dt>
			<dd>{{ date("d/m/Y", strtotime($facturasislr->fecha_fac)) }}</dd>
			<dt>N° Código:</dt>
			<dd>{{ $facturasislr->n_codigo }}</dd>
			<dt>Total:</dt>
			<dd>{{ number_format($facturasislr->total_compra,2,",",".") }}</dd>
			<dt>Objreten:</dt>
			<dd>{{ number_format($facturasislr->objreten,2,",",".") }}</dd>
			<dt>% Retenido:</dt>
			<dd>{{ number_format($facturasislr->iva,2,",",".") }}</dd>
			<dt>Impuesto Retenido:</dt>
			<dd>{{ number_format($facturasislr->impuesto_iva,2,",",".") }}</dd>
		</dl>
		<small><strong>Creado el 
			<cite title="Source Title">
				{{ date("d/m/Y H:i:s a", strtotime($facturasislr->created_at)) }}
			</cite>
			 por 
			<cite>			
		        {{ $user->username }}	            
			</cite>
			</strong>
		</small>
		<small><strong>Ultima actualización el 
			<cite title="Source Title">
				{{ date("d/m/Y H:i:s a", strtotime($facturasislr->updated_at)) }}
			</cite>
			 por 
			<cite>			
		        {{ $user->username }}	            
			</cite>
			</strong>
		</small>
		</blockquote>
    @endif
@stop