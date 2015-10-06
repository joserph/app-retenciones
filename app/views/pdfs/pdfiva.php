<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
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
			font-size: 28px;
			margin: 0 auto;
			margin-top: -25px;
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
			margin-top: -35px;
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
		    padding: 2px;
		    text-align: left;    
		}
		th.reten1{
			text-align: center;
		}
		tr, th{
			font-size: 8px;
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
			padding: 3px;
			font-size: 10px;
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
		
		td.reten7{
			background-color: #C2C2C2;
			font-size: 12px;
		}

		.espacio{
			padding: 20px;
		}
		.text-uppercase {
  			text-transform: uppercase;
		}
		.firma{
			margin-left: 400px;
			margin-top: -10px;
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
	<h1><?php echo "$agentes->nombre" ?></h1>
	<p><?php echo "$agentes->rif" ?> - Teléfonos: <?php echo "$agentes->tlf" ?></p>
	<p>(Ley IVA - Art. 11: "Serán responsables del pago del impuesto en calidad de agentes de retención, los compradores o adquirientes de determinados bienes muebles y los receptores de ciertos servicios a quienes la Administración Tributaria designe como tal")</p>
	<br>
	<div class="der1">
		<p class="n_comp"><span>Nro. Comp.: <?php echo "$reportes->n_comp" ?> </span> <span>Fecha: <?php echo date("d/m/Y", strtotime("$reportes->fecha")) ?> </span></p>
	</div>
	<div class="periodo">
		<p><span class="n_comp">Periodo: <?php echo date("m-Y", strtotime("$reportes->periodo")) ?></span></p>
	</div>
	<div>
		<h2>COMPROBANTE RETENCION DEL I.V.A.</h2>
	</div>
	<div>
		<table class="agente">
			<tr>
				<th class="izq">Nombre o Razón Social del Agente de Retención</th>				
				<th class="der">Registro de Información Fiscal del Agente de Retención</th>
			</tr>
			<tr>
				<td class="titulo text-uppercase"><strong><?php echo "$agentes->nombre" ?></strong></td>
				<td class="rif text-uppercase"><strong><?php echo "$agentes->rif" ?></strong></td>
			</tr>
		</table>
		<table class="direccion">
			<tr>
				<th class="izq">Dirección Fiscal del Agente de Retención</th>
			</tr>
			<tr>
				<td class="dir"><?php echo "$agentes->direccion" ?></td>
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
					<?php echo "$proveedor->nombre"; ?>
					</strong>
				</td>
				<td class="rif">
					<strong>
					<?php echo "$proveedor->rif"; ?>
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
					<?php echo "$proveedor->direccion"; ?>
				</td>
			</tr>
		</table>
	</div>
	
	<div>
		<table class="reten">
	    <tr>
	        <th class="reten1">Nº</th>
	        <th class="reten1">Fecha de la Factura</th>
	        <th class="reten1">Número de Factura</th>  
	        <th class="reten1">Número de Control</th>
	        <th class="reten1">Nº Comprobante</th>
	        <th class="reten1">Nota Débito</th>
	        <th class="reten1">Nota Crédito</th>
	        <th class="reten1">Tipo de Transacción</th>
	        <th class="reten1">Nº Factura Ajustada</th>
	        <th class="reten1">Total Compra incluyendo IVA</th>  
	        <th class="reten1">Compras sin Derecho a Crédito</th>
	        <th class="reten1">Base Imponible</th>
	        <th class="reten1">Alicuota %</th>
	        <th class="reten1">Impuesto IVA</th>
	        <th class="reten1">IVA Retenido</th>
	    </tr>
	    <?php $cont = 0;?>
      	<?php $totalc = 0;?>
      	<?php $totalex = 0;?>
      	<?php $totalbi = 0;?>
      	<?php $totaliva = 0;?>
      	<?php $totalr = 0;?>
	    <?php foreach ($facturas as $factura){ ?>
	    <tr class="reten2">
	        <td class="reten1"><?php echo $cont += 1 ?></td>
	        <td class="reten1"><?php echo date("d/m/Y", strtotime($factura->fecha_fac)) ?></td>
	        <td class="reten1"><?php echo $factura->n_factura ?></td>
	        <td class="reten1"><?php echo $factura->n_control ?></td>
	        <td class="reten1"><?php echo $reportes->n_comp ?></td>
	        <td class="reten1"><?php echo $factura->n_nota_debito ?></td>
	        <td class="reten1"><?php echo $factura->n_nota_credito ?></td>
	        <td class="reten5 text-uppercase"><?php echo $factura->tipo_transa ?></td>
	        <td class="reten1"><?php echo $factura->n_fact_ajustada ?></td>
	        <td class="reten2"><?php echo number_format($factura->total_compra,2,",",".") ?></td><?php $subtotal = $factura->total_compra; ?>
	        <td class="reten2"><?php echo number_format($factura->exento,2,",",".") ?></td><?php $subtotalex = $factura->exento; ?>
	        <td class="reten2"><?php echo number_format($factura->base_imp,2,",",".") ?></td><?php $subtotalbi = $factura->base_imp; ?>
	        <td class="reten1"><?php echo $factura->iva ?></td>
	        <td class="reten2"><?php echo number_format($factura->impuesto_iva,2,",",".") ?></td><?php $subtotaliva = $factura->impuesto_iva; ?>
	        <td class="reten2"><?php echo number_format($factura->iva_retenido,2,",",".") ?></td><?php $subtotalr = $factura->iva_retenido; ?>
	    </tr>
	    <?php $totalc += $subtotal;?>
	    <?php $totalex += $subtotalex;?>
	    <?php $totalbi += $subtotalbi;?>
	    <?php $totaliva += $subtotaliva;?>
	    <?php $totalr += $subtotalr;?>
	    <?php } ?>
	    <tr class"espacio">
	    	<td colspan="15" class"espacio"></td>
	    </tr>
	    <tr>         	
          	<td class="reten3" colspan="9"><strong>Totales</strong></td>  
          	<td class="reten3 reten6"><strong><?php echo number_format($totalc,2,",",".") ?></strong></td>
          	<td class="reten3"><strong><?php echo number_format($totalex,2,",",".") ?></strong></td>
          	<td class="reten3"><strong><?php echo number_format($totalbi,2,",",".") ?></strong></td>
          	<td class="reten3"></td>
          	<td class="reten3"><strong><?php echo number_format($totaliva,2,",",".") ?></strong></td>
          	<td class="reten3 reten6"><strong><?php echo number_format($totalr,2,",",".") ?></strong></td>
      	</tr>
		<?php
			$totalPagar = $totalc - $totalr;
		?>
      	<tr>         	
          	<td class="reten3" colspan="13"><strong>Total a Pagar</strong></td>  
          	<td class="reten3 reten7" colspan="2"><strong><?php echo number_format($totalPagar,2,",",".") ?></strong></td>
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
</body>
</html>
