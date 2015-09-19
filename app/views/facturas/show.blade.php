@extends ('master.layout')
@section ('title') Facturas |  @stop
@section ('content')

   	<legend>
   		<h3>
   			@if($facturas->n_nota_debito != null)
   				Nota de Débito: {{ $facturas->n_nota_debito }}
   			@elseif($facturas->n_nota_credito != null)
   				Nota de Crédito: {{ $facturas->n_nota_credito }}
   			@else 
   				Factura: {{ $facturas->n_factura }}
   			@endif
   		</h3>
   	</legend>
   	
	<blockquote>
	<dl class="dl-horizontal">
		<dt>Retención:</dt>		
        <dd>{{ $reporte->n_comp }}</dd>           
		<dt>Fecha:</dt>
		<dd>{{ date("d/m/Y", strtotime($facturas->fecha_fac)) }}</dd>
		<dt>N° Factura:</dt>
		<dd>{{ $facturas->n_factura }}</dd>
		<dt>N° Control:</dt>
		<dd>{{ $facturas->n_control }}</dd>
		<dt>Nota de Débito:</dt>
		<dd>{{ $facturas->n_nota_debito }}</dd>
		<dt>Nota de Crédito:</dt>
		<dd>{{ $facturas->n_nota_credito }}</dd>
		<dt>Tipo Transacción:</dt>
		<dd class="text-uppercase">{{ $facturas->tipo_transa }}</dd>
		<dt>N° Factura Ajustada:</dt>
		<dd>{{ $facturas->n_fact_ajustada }}</dd>
		<dt>Total Compra:</dt>
		<dd>{{ number_format($facturas->total_compra,2,",",".") }}</dd>
		<dt>Exento:</dt>
		<dd>{{ number_format($facturas->exento,2,",",".") }}</dd>
		<dt>Base Imponible:</dt>
		<dd>{{ number_format($facturas->base_imp,2,",",".") }}</dd>
		<dt>IVA:</dt>
		<dd>{{ $facturas->iva }}%</dd>
		<dt>Impuesto IVA:</dt>
		<dd>{{ number_format($facturas->impuesto_iva,2,",",".") }}</dd>
		<dt>IVA Retenido:</dt>
		<dd>{{ number_format($facturas->iva_retenido,2,",",".") }}</dd>
	</dl>
	<small><strong>Creado el 
		<cite title="Source Title">
			{{ date("d/m/Y", strtotime($facturas->created_at)) }}
			a las
			{{ date("H:i:s a", strtotime($facturas->created_at)) }}
		</cite>
		 por 
		<cite>			
	    	{{ $user->username }}	           
		</cite>
		</strong>
	</small>
	<small><strong>Ultima actualización el 
		<cite title="Source Title">
			{{ date("d/m/Y", strtotime($facturas->updated_at)) }}
			a las 
			{{ date("H:i:s a", strtotime($facturas->updated_at)) }}
		</cite>
		 por 
		<cite>			
	        {{ $user->username }}	            
		</cite>
		</strong>
	</small>
	</blockquote>
     
@stop