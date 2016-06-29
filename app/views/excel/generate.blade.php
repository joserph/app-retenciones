<td> </td>
<table class="table table-striped table-hover table-responsive">
    @foreach ($reportes as $item)
        @foreach($facturas as $factura)
            @if($factura->id_reporte == $item->id)
                <tr>

                    <td>{{ str_replace('-', '', $agente->rif) }}</td>
                    <td>{{ $item->periodo }}</td>
                    <td>{{ $factura->fecha_fac }}</td>                    
                    @if($factura->tipo_transa == 'compras')
                        <td>C</td>
                    @else
                        <td>V</td>
                    @endif                    
                    
                    @if($factura->tipo_transa == 'compras')
                        <td>01</td>
                    @elseif($factura->tipo_transa == 'nota de credito')
                        <td>03</td>
                    @else
                        <td>02</td>
                    @endif
                    
                    @foreach($proveedores as $proveedor)
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
</table>