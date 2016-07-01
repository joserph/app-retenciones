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
                        @if($item->id_proveedor == $proveedor->id)
                            <td>{{ str_replace('-', '', $proveedor->rif) }}</td>
                        @endif
                    @endforeach
                    
                    @if($factura->tipo_transa == 'compras')
                        <td>{{ $factura->n_factura }}</td>
                    @elseif($factura->tipo_transa == 'nota de credito')
                        <td>{{ $factura->n_nota_credito }}</td>
                    @else
                        <td>{{ $factura->n_nota_debito }}</td>
                    @endif
                    <td>{{ $factura->n_control }}</td>
                    <td>{{ number_format($factura->total_compra,2,",",".") }}</td>
                    <td>{{ number_format($factura->base_imp,2,",",".") }}</td>
                    <td>{{ number_format($factura->iva_retenido,2,",",".") }}</td>
                    @if($factura->n_fact_ajustada == '')
                        <td>0</td>
                    @else
                        <td>{{ $factura->n_fact_ajustada }}</td>
                    @endif
                    <td>{{ $item->n_comp }}</td>
                    <td>{{ number_format($factura->exento,2,",",".") }}</td>
                    <td>{{ number_format($factura->iva,2,",",".") }}</td>
                    <td>0</td>           
                </tr>
            @endif
        @endforeach
    @endforeach