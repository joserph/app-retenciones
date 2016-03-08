<td> </td>
<table class="table table-striped table-hover table-responsive">
    <tr>
        <th>R.I.F.</th>                
        <th>Periodo</th>
        <th>Fecha</th>  
        <th>Tipo Op.</th>
        <th>Tipo Doc.</th>                
        <th>R.I.F. Prov.</th>
        <th>Numero de Doc.</th>  
        <th>Numero de Cont.</th>
        <th>Monto total</th>
        <th>Base Imp.</th>                
        <th>I.V.A. Rete.</th>
        <th>N. Fact. Afec.</th>  
        <th>Numero Comp.</th>
        <th>Exento</th>                
        <th>Impuesto</th>
        <th>N. Expediente</th>  
    </tr>
    @foreach ($reportes as $item)
        @foreach($facturas as $factura)
            @if($factura->id_reporte == $item->id)
                <tr>
                    <td>{{ $agente->rif }}</td>
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
                            <td>{{ $proveedor->rif }}</td>
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
                    <td>{{ $factura->total_compra }}</td>
                    <td>{{ $factura->base_imp }}</td>
                    <td>{{ $factura->iva_retenido }}</td>
                    <td>{{ $factura->n_fact_ajustada }}</td>
                    <td>{{ $item->n_comp }}</td>
                    <td>{{ $factura->exento }}</td>
                    <td>{{ $factura->iva }}</td>
                    <td>0</td>           
                </tr>
            @endif
        @endforeach
    @endforeach
</table>