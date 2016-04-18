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
    @if($totalFactuasIslr > 0)
		<br>
	    <hr>
	    @if($empleados->tipo == 'empleado')
	    	<legend><h3><i class="fa fa-bars fa-fw"></i> Histórico pagos de {{ $empleados->nombre }}</h3></legend>
	    @else    	
	    	<legend><h3><i class="fa fa-bars fa-fw"></i> Histórico facturas de {{ $empleados->nombre }}</h3></legend>
	    @endif
    
	    <div class="table-responsive">
	        <table class="table table-striped table-hover table-responsive">
	            <tr>
	                <th>#</th>
	                <th class="text-center">Retención</th> 
	                <th class="text-center">Fecha</th> 
	                <th class="text-center">Factura</th>
	                <th class="text-center">Nº Código</th>
	                <th class="text-center">Nº Control</th>        
	                <th class="text-center">Total</th>
	                <th class="text-center">Objreten</th>
	                <th class="text-center">Base Imponible</th>
	                <th class="text-center">% Retenido</th>
	                <th class="text-center">Impuesto Retenido</th>
	                <th class="text-center">Acciones</th>
	            </tr>
	            @foreach ($facturasIslr as $factura)
	            <tr>
	                <td>{{ $contador += 1 }}</td>        
	                <td class="text-center"><a href="{{ route('islr-reportes.show', $factura->reporteislr->id) }}">{{ $factura->reporteislr->n_comp }}</a></td>            
	                <td class="text-center">{{ date("d/m/Y", strtotime($factura->fecha_fac)) }}</td>
	                <td class="text-center">{{ $factura->n_factura }}</td>
	                <td class="text-center">{{ $factura->n_codigo }}</td>
	                <td class="text-center">{{ $factura->n_control }}</td>
	                <td class="text-center">{{ number_format($factura->total_compra,2,",",".") }}</td>
	                <td class="text-center">{{ number_format($factura->objreten,2,",",".") }}</td>
	                <td class="text-center">{{ number_format($factura->base_imp,2,",",".") }}</td>
	                <td class="text-center">{{ number_format($factura->iva,2,",",".") }}</td>
	                <td class="text-center">{{ number_format($factura->impuesto_iva,2,",",".") }}</td>
	                <td class="text-center">
	                    <a href="{{ route('islr-facturas.show', $factura->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye fa-fw"></i> Ver</a>
	                </td>
	            </tr>
	            @endforeach
	        </table>
	    </div>
    @endif
@stop