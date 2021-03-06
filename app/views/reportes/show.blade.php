@extends ('master.layout')
@section ('title') Nº Comprobante: {{ $reportes->n_comp }} | App-Retenciones @stop
@section ('content')

    <legend><h3><i class="fa fa-file-pdf-o fa-fw"></i> Nº Comprobante: {{ $reportes->n_comp }}</h3></legend>
    <ul class="breadcrumb">
      <li><a href="{{ URL::route('home') }}">Inicio</a></li>
      <li><a href="{{ route('reportes.index') }}">Lista de Retenciones I.V.A.</a></li>
      <li class="active">Nº Comprobante: {{ $reportes->n_comp }}</li>
    </ul>

    <div class="table-responsive">
      <table class="table table-bordered table-responsive">
          <tr>
              <td class="active text-center"><strong>Nº Comprobante</strong></td> 
              <td class="active text-center"><strong>Fecha</strong></td> 
              <td class="active text-center"><strong>Periodo</strong></td> 
              <td class="active text-center"><strong>Agente de retención</strong></td> 
              <td class="active text-center"><strong>Sujeto retenido</strong></td> 
              <td class="active text-center"><strong>Porcentaje retención</strong></td>                    
          </tr>
           <tr>
              <td class="text-center text-capitalize warning">{{ $reportes->n_comp }}</td> 
              <td class="text-center text-capitalize warning">{{ date("d/m/Y", strtotime($reportes->fecha)) }}</td> 
              <td class="text-center text-capitalize warning">{{ date("m-Y", strtotime($reportes->periodo)) }}</td> 
              <td class="text-center text-capitalize warning">{{ $agente->nombre }}</td> 
              <td class="text-center text-capitalize warning">{{ $proveedor->nombre }}</td> 
              <td class="text-center text-capitalize warning">{{ $proveedor->porcentaje }}%</td>                   
          </tr>
      </table>
    </div>
    <input type="hidden" value="{{ $proveedor->porcentaje }}" id="porcentaje">
    <a href="{{ route('reportes.edit', $reportes->id) }}" class="col-xs-6 col-sm-6 btn btn-warning"><i class="fa fa-edit fa-fw"></i> Editar comprobante</a>
  <br>
  <hr>
<!-- Large modal -->
<!-- Button trigger modal -->
    
  <button class="col-xs-6 col-sm-6 btn btn-success" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Agregar factura, nota de crédito o nota de débito">
    <i class="fa fa-plus-circle fa-fw"></i>  Agregar factura
  </button>


  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h3 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Agregar factura</h3>
        </div>
        <div class="modal-body">
          @include('facturas.form')
        </div>
      </div>
    </div>
  </div>
<!-- Fin Large modal -->
  @if($facturasCount > 0)
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
            <th class="text-center">Acción</th>
        </tr>        
        <?php 
          $totalc = 0;
          $totalex = 0;
          $totalbi = 0;
          $totaliva = 0;
          $totalr = 0;
        ?>
        @foreach ($todasFacturas as $item)
        <tr>
            <td>{{ $contador += 1 }}</td>
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
             <a href="{{ route('facturas.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a>
            </td>
        </tr>
        <?php 
          $totalc += $subtotal;
          $totalex += $subtotalex;
          $totalbi += $subtotalbi;
          $totaliva += $subtotaliva;
          $totalr += $subtotalr;
        ?>
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
  
  <a href="{{ route('pdfiva', $reportes->id) }}" target="_blank" class="col-xs-6 col-sm-6 btn btn-info"><i class="fa fa-file-pdf-o"></i> Generar Reporte</a>
  @endif 
  @section('script')
  <script>
    function calcular(i)
    {
      guion = "-";
      n_factura = $('#n_factura'+i).val();
      if(n_factura == '') n_factura = 0;

      n_control = $('#n_control'+i).val();
      if(n_control == '') n_control = 0;

      factura = n_factura + guion + n_control;
      $('#factura'+i).val(factura);

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
  @stop
@stop
