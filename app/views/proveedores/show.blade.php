@extends ('master.layout')
@section ('title') {{ $proveedores->nombre }} | App-Retenciones @stop
@section ('content')

   	<legend><h3><i class="fa fa-building-o fa-fw"></i> {{ $proveedores->nombre }}</h3></legend>
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
	@if(Auth::check())
    	<a href="{{ route('proveedores.edit', $proveedores->id) }}" class="col-xs-6 col-sm-6 btn btn-warning"><i class="fa fa-edit fa-fw"></i> Editar</a>
    @endif
    @if($totalFacturas > 0)
	    <br>
	    <hr>
	    <legend><h3><i class="fa fa-bars fa-fw"></i> Histórico facturas de {{ $proveedores->nombre }}</h3></legend>    
	    <div class="table-responsive">
	        <table class="table table-striped table-hover table-responsive">
	            <tr>
	                <th>#</th>
	                <th class="text-center">Factura</th>        
	                <th class="text-center">Nota Crédito</th>
	                <th class="text-center">Nota Débito</th>
	                <th class="text-center">Retención</th> 
	                <th class="text-center">Fecha</th> 
	                <th class="text-center">Nº Control</th>
	                <th class="text-center">Tipo Trans.</th>
	                <th class="text-center">Monto</th>
	            </tr>
	            @foreach ($facturas as $item)
	            <tr>
	                <td>{{ $contador += 1 }}</td>
	                <td class="text-center">{{ $item->n_factura }}</td>
	                <td class="text-center">{{ $item->n_nota_credito }}</td>
	                <td class="text-center">{{ $item->n_nota_debito }}</td>        
	                <td class="text-center"><a href="{{ route('reportes.show', $item->reporte->id) }}">{{ $item->reporte->n_comp }}</a></td>            
	                <td class="text-center">{{ date("d/m/Y", strtotime($item->fecha_fac)) }}</td>
	                <td class="text-center">{{ $item->n_control }}</td>
	                <td class="text-uppercase text-center">{{ $item->tipo_transa }}</td>
	                <td class="text-center">{{ number_format($item->total_compra,2,",",".") }}</td>        
	            </tr>
	            @endforeach
	        </table>
	    </div>
    @endif
@stop