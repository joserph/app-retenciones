<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nº Comprobante: {{ $reportesislr->n_comp }} | App-Retenciones</title>
	{{ HTML::style('assets/img/favicon.jpg', array('rel' => 'shortcut icon', 'type' => 'image/ico')) }}

	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			color: #000;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			text-align:center;
			font-size: 30px;
			margin: 0 auto;
		}
		p{
			font-size: 12px;
			text-align:center;
		}
		.der1 p{
			margin-top: -10px;
			text-align: right;
		}
		.n_comp{
			font-size: 15px;
		}
		span{
			border: 0.5px solid;
			padding: 10px;
		}
		h2{
			text-align: center;
			padding: 20px;
			margin-top: -5px;
			font-size: 19px;
		}
		.periodo p{
			margin-top: -5px;
			text-align: right;
		}
		.izq{
			text-align: left;
			font-size: 9px;
			width: 710px;
			padding: 0;
		}
		.izq2{
			text-align: left;
			font-size: 9px;
			width: 731px;
			padding: 0;
		}
		.der{
			text-align: right;
			font-size: 9px;
		}
		.rif{
			text-align: center;
			font-size: 12px;
			margin-left: -150px;
		}
		.titulo{
			text-align: center;
			font-size: 13px;
		}
		tr td{
			border: 0.5px solid;
		}
		.agente{
			border-spacing: 3px;
			margin-top: -25px;
		}
		.direccion{
			width: 960px;
			border-spacing: 3px;
			margin-top: -4px;
		}
		.dir{
			font-size: 13px;
			text-align: center;
		}
		.proveedor{
			border-spacing: 3px;
			margin-top: -4px;
		}
		table.reten, th.reten1, td.reten1 {
		    border: 1px solid black;
		    border-collapse: collapse;
		}
		table.firma1, th.reten1, td.reten1 {
		    border: 1px solid black;
		    border-collapse: collapse;
		}
		th.reten1, td.reten1 {
		    padding: 8px;
		    text-align: left;    
		}
		th.reten1{
			text-align: center;
		}
		tr, th{
			font-size: 12px;
		}
		td.reten1{			
			text-align: center;
		}
		td.reten2{
			text-align: right;
			padding: 3px;
		}
		td.reten3{
			text-align: right;
			padding: 5px;
			font-size: 13px;
		}
		td.reten4{
			text-align: right;
			padding: 5px;
			font-size: 10px;
			border: 1px solid white;
		}
		td.reten5{
			text-align: center;
			padding: 0px;
		}
		.espacio{
			padding: 20px;
		}
		.text-uppercase {
  			text-transform: uppercase;
		}
		.firma{
			margin-left: 400px;
		}
		tr th.firma2{
			font-size: 10px;
			padding: 5px 30px 5px 30px;
		}
		tr td.firma2{
			font-size: 13px;
			padding: 30px;
		}
	</style>
</head>
<body>
	
    @if($proveedor->tipo == 'proveedor')
		<h1>{{ $agente->nombre }}</h1>
		<p>{{ $agente->rif }} - Teléfonos: {{ $agente->tlf }}</p>
		<p>(Ley IVA - Art. 11: "Serán responsables del pago del impuesto en calidad de agentes de retención, los compradores o adquirientes de determinados bienes muebles y los receptores de ciertos servicios a quienes la Administración Tributaria designe como tal")</p>
		<br>
		<div class="der1">
			<p class="n_comp"><span>Nro. Comp.: {{ $reportesislr->n_comp }} </span> <span>Fecha: {{ date("d/m/Y", strtotime("$reportesislr->fecha")) }}  </span></p>
		</div>
		<div class="periodo">
			<p><span class="n_comp">Periodo: {{ date("m-Y", strtotime("$reportesislr->periodo")) }}</span></p>
		</div>
		<div>
			<h2>COMPROBANTE RETENCION DEL I.S.L.R.</h2>
		</div>
		<div>
			<table class="agente">
				<tr>
					<th class="izq">Nombre o Razón Social del Agente de Retención</th>				
					<th class="der">Registro de Información Fiscal del Agente de Retención</th>
				</tr>
				<tr>
					<td class="titulo text-uppercase"><strong>{{ $agente->nombre }}</strong></td>
					<td class="rif text-uppercase"><strong>{{ $agente->rif }}</strong></td>
				</tr>
			</table>
			<table class="direccion">
				<tr>
					<th class="izq">Dirección Fiscal del Agente de Retención</th>
				</tr>
				<tr>
					<td class="dir">{{ $agente->direccion }}</td>
				</tr>
			</table>
			<table class="proveedor">
				<tr>
					<th class="izq2">Nombre o Razón Social del Sujeto Retenido</th>				
					<th class="der">Registro de Información Fiscal del Sujeto Retenido</th>
				</tr>
				<tr>
					<td class="titulo text-uppercase">
						<strong>					
							{{ $proveedor->nombre }}
						</strong>
					</td>
					<td class="rif">
						<strong>
							{{ $proveedor->rif }}
						</strong>
					</td>
				</tr>
			</table>
			<table class="direccion">
				<tr>
					<th class="izq">Dirección Fiscal del Sujeto Retenido</th>
				</tr>
				<tr>
					<td class="dir">
						{{ $proveedor->direccion }}
					</td>
				</tr>
			</table>
		</div>
		<br>
		<div>
			<table class="reten">
		    <tr>
		        <th class="reten1">Nº</th>
		        <th class="reten1">Fecha de Factura</th>
		        <th class="reten1">Número de Factura</th>  
		        <th class="reten1">Número de Control</th>
		        <th class="reten1">Nº Comprobante</th>
		        <th class="reten1">Cantidad Pagada o Abonada en Cuenta</th>  	        
		        <th class="reten1">Cantidad Objeto de Retención</th>
		        <th class="reten1">% Retenido</th>
		        <th class="reten1">Sustraendo</th>
		        <th class="reten1">Monto abonado</th>
		        <th class="reten1">Total Impuesto Retenido</th>	        
		    </tr>
		    <?php 
		    	$cont = 0;
	      		$totalc = 0;
	      		$totalex = 0;
	      		$totalbi = 0;
	      		$totaliva = 0;
	      		$totalr = 0;
	      	?>
	      	@foreach($facturasislr as $factura)
		    <tr class="reten2">
		        <td class="reten1">{{ $cont += 1 }}</td>
		        <td class="reten1">{{ date("d/m/Y", strtotime($factura->fecha_fac)) }}</td>
		        <td class="reten1">{{ $factura->n_factura }}</td>
		        <td class="reten1">{{ $factura->n_control }}</td>
		        <td class="reten1">{{ $reportesislr->n_comp }}</td>
		        <td class="reten2">{{ number_format($factura->total_compra,2,",",".") }}</td><?php $subtotal = $factura->total_compra; ?>
		        <td class="reten2">{{ number_format($factura->base_imp,2,",",".") }}</td><?php $subtotalbi = $factura->base_imp; ?>		        
		        <td class="reten1">{{ number_format($factura->iva,2,",",".") }}</td>
		        <td class="reten1">{{ number_format($proveedor->sustraendo, 2, ",", ".") }}</td><?php $montoAbonado = (($factura->base_imp * $factura->iva)/100)-$proveedor->sustraendo; ?>
		        <td class="reten2">{{ number_format($montoAbonado, 2, ",", ".") }}</td>
		        <td class="reten2">{{ number_format($montoAbonado,2,",",".") }}</td><?php $subtotaliva = $montoAbonado; ?>
		    </tr>
		    <?php 
			    $totalc += $subtotal;
			    $totalbi += $subtotalbi;
			    $totaliva += $subtotaliva;
		    ?>
		    @endforeach
		    <tr class"espacio">
		    	<td colspan="11" class"espacio"></td>
		    </tr>
		    <tr>         	
	          	<td class="reten3" colspan="5"><strong>Totales</strong></td>  
	          	<td class="reten3"><strong>{{ number_format($totalc,2,",",".") }}</strong></td>
	          	<td class="reten3"><strong>{{ number_format($totalbi,2,",",".") }}</strong></td>
	          	<td class="reten3"></td>
	          	<td class="reten3"></td>
	          	<td class="reten3"></td>
	          	<td class="reten3"><strong>{{ number_format($totaliva,2,",",".") }}</strong></td>
	      	</tr>	       
		  	</table>
		</div>
		<br>
		<div class="firma">
			<table class="firma1">
				<tr>
					<th class="firma2">Firma y Sello del Agente de Retención</th>
				</tr>
				<tr>
					<td class="firma2"></td>
				</tr>
			</table>
		</div>
	@else 
		<h1>{{ $agente->nombre }}</h1>
		<p>{{ $agente->rif }} - Teléfonos: {{ $agente->tlf }}</p>
		<p>(Ley IVA - Art. 11: "Serán responsables del pago del impuesto en calidad de agentes de retención, los compradores o adquirientes de determinados bienes muebles y los receptores de ciertos servicios a quienes la Administración Tributaria designe como tal")</p>
		<br>
		<div class="der1">
			<p class="n_comp"><span>Nro. Comp.: {{ $reportesislr->n_comp }} </span> <span>Fecha: {{ date("d/m/Y", strtotime("$reportesislr->fecha")) }} </span></p>
		</div>
		<div class="periodo">
			<p><span class="n_comp">Periodo: {{ date("m-Y", strtotime("$reportesislr->periodo")) }} </span></p>
		</div>
		<div>
			<h2>COMPROBANTE RETENCION DEL I.S.L.R.</h2>
		</div>
		<div>
			<table class="agente">
				<tr>
					<th class="izq">Nombre o Razón Social del Agente de Retención</th>				
					<th class="der">Registro de Información Fiscal del Agente de Retención</th>
				</tr>
				<tr>
					<td class="titulo text-uppercase"><strong>{{ $agente->nombre }}</strong></td>
					<td class="rif text-uppercase"><strong>{{ $agente->rif }}</strong></td>
				</tr>
			</table>
			<table class="direccion">
				<tr>
					<th class="izq">Dirección Fiscal del Agente de Retención</th>
				</tr>
				<tr>
					<td class="dir">{{ $agente->direccion }}</td>
				</tr>
			</table>
			<table class="proveedor">
				<tr>
					<th class="izq2">Nombre o Razón Social del Sujeto Retenido</th>				
					<th class="der">Registro de Información Fiscal del Sujeto Retenido</th>
				</tr>
				<tr>
					<td class="titulo text-uppercase">
						<strong>
							{{ $proveedor->nombre }}
						</strong>
					</td>
					<td class="rif">
						<strong>					
							{{ $proveedor->rif }}
						</strong>
					</td>
				</tr>
			</table>
			<table class="direccion">
				<tr>
					<th class="izq">Dirección Fiscal del Sujeto Retenido</th>
				</tr>
				<tr>
					<td class="dir">					
						{{ $proveedor->direccion }}
					</td>
				</tr>
			</table>
		</div>
		<br>
		<div>
			<table class="reten">
		    <tr>
		        <th class="reten1">Nº</th>
		        <th class="reten1">Fecha</th> 
		        <th class="reten1">Número de Código</th>
		        <th class="reten1">Nº Comprobante</th>
		        <th class="reten1">Cantidad Pagada o Abonada en Cuenta</th>  	        
		        <th class="reten1">Cantidad Objeto de Retención</th>
		        <th class="reten1">% Retenido</th>
		        <th class="reten1">Total Impuesto Retenido</th>	        
		    </tr>
		    <?php 
		    	$cont = 0;
	      	 	$totalc = 0;
	      	 	$totalex = 0;
	      		$totalbi = 0;
	      	 	$totaliva = 0;
	      		$totalr = 0;
	      	?>
		    @foreach($facturasislr as $factura)
		    <tr class="reten2">
		        <td class="reten1">{{ $cont += 1 }}</td>
		        <td class="reten1">{{ date("d/m/Y", strtotime($factura->fecha_fac)) }}</td>
		        <td class="reten1">{{ $factura->n_codigo }}</td>
		        <td class="reten1">{{ $reportesislr->n_comp }}</td>
		        <td class="reten2">{{ number_format($factura->total_compra,2,",",".") }}</td><?php $subtotal = $factura->total_compra; ?>
		        <td class="reten2">{{ number_format($factura->objreten,2,",",".") }}</td><?php $subtotalbi = $factura->objreten; ?>
		        <td class="reten1">{{ number_format($factura->iva,2,",",".") }}</td>
		        <td class="reten2">{{ number_format($factura->impuesto_iva,2,",",".") }}</td><?php $subtotaliva = $factura->impuesto_iva; ?>
		    </tr>
		    <?php 
		    	$totalc += $subtotal;
		     	$totalbi += $subtotalbi;
		    	$totaliva += $subtotaliva;
		    ?>
		    @endforeach
		    <tr class"espacio">
		    	<td colspan="8" class"espacio"></td>
		    </tr>
		    <tr>         	
	          	<td class="reten3" colspan="4"><strong>Totales</strong></td>  
	          	<td class="reten3"><strong>{{ number_format($totalc,2,",",".") }}</strong></td>
	          	<td class="reten3"><strong>{{ number_format($totalbi,2,",",".") }}</strong></td>
	          	<td class="reten3"></td>
	          	<td class="reten3"><strong>{{ number_format($totaliva,2,",",".") }}</strong></td>
	      	</tr>	       
		  	</table>
		</div>
		<br>
		<div class="firma">
			<table class="firma1">
				<tr>
					<th class="firma2">Firma y Sello del Agente de Retención</th>
				</tr>
				<tr>
					<td class="firma2"></td>
				</tr>
			</table>
		</div>

	@endif
    	
</body>
</html>
