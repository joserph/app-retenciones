@foreach ($reportes as $item)
    @foreach($facturas as $factura)
        @if($factura->id_reporte == $item->id)
        	<?php
            $rifAgente = str_replace('-', '', $agente->rif);
            $periodo = $item->periodo;
            $fechaFactura = $factura->fecha_fac;

            if($factura->tipo_transa == 'compras')
            {
            	$tipoTransa = "C";
            }else{
            	$tipoTransa = "V";
            }

            if($factura->tipo_transa == 'compras')
            {
            	$tipoTransaNun = "01";
            }elseif($factura->tipo_transa == 'nota de credito')
            {
            	$tipoTransaNun = "03";
            }else
            {
            	$tipoTransaNun = "02";
            }
            //Seguir el 01/07/2016
            foreach($proveedores as $proveedor)
            {
                if($item->id_proveedor == $proveedor->id)
                {
                    $rifProveedor = str_replace('-', '', $proveedor->rif);
                }
            }
                
            if($factura->tipo_transa == 'compras')
            {
                $tipoTransaFac = $factura->n_factura;
            }elseif($factura->tipo_transa == 'nota de credito')
            {
                $tipoTransaFac = $factura->n_nota_credito;
            }else
            {
                $tipoTransaFac = $factura->n_nota_debito;
            }
            $numControl = $factura->n_control;
            $totalCompra = number_format($factura->total_compra,2,".","");
            $baseImp = number_format($factura->base_imp,2,".","");
            $ivaRetenido = number_format($factura->iva_retenido,2,".","");

            if($factura->n_fact_ajustada == '')
            {
                $numFacAjus = "0";
            }else
            {
                $numFacAjus = $factura->n_fact_ajustada;
            }
            $numComp = $item->n_comp;
            $exento = number_format($factura->exento,2,".","");
            $iva = number_format($factura->iva,2,".","");
            $ultimo = "0";        
           
echo $rifAgente ."\t". $periodo ."\t". $fechaFactura ."\t". $tipoTransa ."\t". $tipoTransaNun ."\t". $rifProveedor ."\t". $tipoTransaFac ."\t". $numControl ."\t". $totalCompra ."\t". $baseImp ."\t". $ivaRetenido ."\t". $numFacAjus ."\t". $numComp ."\t". $exento ."\t". $iva ."\t". $ultimo ."\R";
 ?>
        @endif
    @endforeach
@endforeach


