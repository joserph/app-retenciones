@extends ('master.layout')
@section ('title') Agente de retención |  @stop
@section ('content')
<?php
  if(is_null($iva)){
    $actual = 0;
  }else{
    $actual = $iva->iva;
  }
?>
<script type="text/javascript">
  function calcular(i)
  {
    prueba = $('#totall').val();
    $('#prueba').val(prueba);

    total = $('#total'+i).val();
    if(total == '') total = 0;

      exento = $('#exento'+i).val();
      if (exento == '')  exento = 0;

      base_imp = (total - exento)/1.12;
      $('#base_imp'+i).val((base_imp).toFixed(2));
      
      base_imp = $('#base_imp'+i).val();
      if(base_imp == '') base_imp = 0;
      
      iva = $('#iva'+i).val();

      impuesto = (base_imp * iva)/100;
      $('#impuesto'+i).val((impuesto).toFixed(2));

      impuesto = $('#impuesto'+i).val();
      if(impuesto == '') impuesto = 0;

      porcentaje = $('#porcentaje').val();
      iva_retenido = (impuesto * porcentaje)/100;
      $('#iva_retenido'+i).val((iva_retenido).toFixed(2));
      

  }
</script>
    <legend><h3>Nº Comprobante: {{ $reportes->n_comp }}</h3></legend>
    <ul class="breadcrumb">
      <li><a href="{{ URL::route('home') }}">Inicio</a></li>
      <li><a href="{{ route('reportes.index') }}">Lista de Retenciones ISLR</a></li>
      <li class="active">Nº Comprobante: {{ $reportes->n_comp }}</li>
    </ul>
    <p>Nº Comprobante: <mark>{{ $reportes->n_comp }}</mark></p>
    <p>Fecha: <mark>{{ date("d/m/Y", strtotime($reportes->fecha)) }}</mark></p>
    <p>Periodo: <mark>{{ date("m-Y", strtotime($reportes->periodo)) }}</mark></p>
    <p>Agente de retención: 
      <mark>        
        {{ $agente->nombre }}          
      </mark>
    </p>
    <p>Sujeto retenido:
      <mark>
        @foreach($proveedores as $proveedor)
          @if($proveedor->id == $reportes->id_proveedor)
            {{ $proveedor->nombre }}
          @endif
        @endforeach
      </mark>
    </p>
    <p>Porcentaje retención: 
      <mark>
        @foreach($proveedores as $proveedor)
          @if($proveedor->id == $reportes->id_proveedor)
            {{ $proveedor->porcentaje }} %
            <input type="hidden" value="{{ $proveedor->porcentaje }}" id="porcentaje">
          @endif
        @endforeach
      </mark>
    </p>
    <div class="row">
      <div class="col-md-4">
        <a href="{{ route('reportes.edit', $reportes->id) }}" class="btn btn-warning"> Editar</a>
      </div>
  </div>
  <br>

<!-- Large modal -->
<!-- Button trigger modal -->
<button class="btn btn-success" data-toggle="modal" data-target="#myModal">
    Agregar Factura
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel">Agregar factura</h4>
        </div>
        <div class="modal-body">
          
        </div>
      </div>
    </div>
  </div>
<!-- Fin Large modal -->
  @if($totalFacturas > 0)
    <br><br>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-responsive">
        <tr>
            <th>#</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Factura</th>  
            <th class="text-center">Nº Control</th>
            <th class="text-center">Nota de Débito</th>
            <th class="text-center">Nota de Crédito</th>
            <th class="text-center">Tipo Trans.</th>
            <th class="text-center">Factura Ajustada</th>  
            <th class="text-center">Total</th>
            <th class="text-center">Exento</th>
            <th class="text-center">Base Imponible</th>
            <th class="text-center">IVA</th>
            <th class="text-center">Impuesto IVA</th>
            <th class="text-center">IVA Retenido</th>
            <th class="text-center">Acciones</th>
        </tr>
        <?php $cont = 0;?>
        <?php $totalc = 0;?>
        <?php $totalex = 0;?>
        <?php $totalbi = 0;?>
        <?php $totaliva = 0;?>
        <?php $totalr = 0;?>
        @foreach ($items as $item)
        <tr>
            <td>{{ $cont += 1 }}</td>
            <td>{{ date("d/m/Y", strtotime($item->fecha_fac)) }}</td>
            <td class="text-uppercase">{{ $item->n_factura }}</td>
            <td>{{ $item->n_control }}</td>
            <td>{{ $item->n_nota_debito }}</td>
            <td>{{ $item->n_nota_credito }}</td>
            <td class="text-uppercase">{{ $item->tipo_transa }}</td>
            <td>{{ $item->n_fact_ajustada }}</td>
            <td>{{ number_format($item->total_compra,2,",",".") }}</td><?php $subtotal = $item->total_compra; ?>
            <td>{{ number_format($item->exento,2,",",".") }}</td><?php $subtotalex = $item->exento; ?>
            <td>{{ number_format($item->base_imp,2,",",".") }}</td><?php $subtotalbi = $item->base_imp; ?>
            <td>{{ $item->iva }}</td>
            <td>{{ number_format($item->impuesto_iva,2,",",".") }}</td><?php $subtotaliva = $item->impuesto_iva; ?>
            <td>{{ number_format($item->iva_retenido,2,",",".") }}</td><?php $subtotalr = $item->iva_retenido; ?>
            <td class="text-center">
             <a href="{{ route('facturas.edit', $item->id) }}" class="btn btn-warning btn-xs"> Editar</a>
            </td>
        </tr>
        <?php $totalc += $subtotal;?>
        <?php $totalex += $subtotalex;?>
        <?php $totalbi += $subtotalbi;?>
        <?php $totaliva += $subtotaliva;?>
        <?php $totalr += $subtotalr;?>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>  
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Totales</strong></td>  
            <td><strong>{{ number_format($totalc,2,",",".") }}</strong></td>
            <td><strong>{{ number_format($totalex,2,",",".") }}</strong></td>
            <td><strong>{{ number_format($totalbi,2,",",".") }}</strong></td>
            <td></td>
            <td><strong>{{ number_format($totaliva,2,",",".") }}</strong></td>
            <td><strong>{{ number_format($totalr,2,",",".") }}</strong></td>
            <td></td>
        </tr>     
      </table>
    </div>
  @endif 
  <a href="#" target="_blank" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Generar Reporte</a>
@stop
