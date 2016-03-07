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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>           
                </tr>
            @endif
        @endforeach
    @endforeach
</table>