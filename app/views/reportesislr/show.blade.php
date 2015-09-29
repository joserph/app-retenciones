@extends ('master.layout')
@section ('title') Nº Comprobante: {{ $reportesislr->n_comp }} | App-Retenciones @stop
@section ('content')

  <legend><h3><i class="fa fa-file-pdf-o fa-fw"></i> Nº Comprobante: {{ $reportesislr->n_comp }}</h3></legend>
  <ul class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">Inicio</a></li>
    <li><a href="{{ route('reportesislr.index') }}">Lista de Retenciones I.S.L.R.</a></li>
    <li class="active">Nº Comprobante: {{ $reportesislr->n_comp }}</li>
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
            <td class="text-center text-capitalize success">{{ $reportesislr->n_comp }}</td> 
            <td class="text-center text-capitalize success">{{ date("d/m/Y", strtotime($reportesislr->fecha)) }}</td> 
            <td class="text-center text-capitalize success">{{ date("m-Y", strtotime($reportesislr->periodo)) }}</td> 
            <td class="text-center text-capitalize success">{{ $agente->nombre }}</td> 
            <td class="text-center text-capitalize success">{{ $proveedor->nombre }}</td> 
            <td class="text-center text-capitalize success">{{ $proveedor->porcentaje }}%</td>                   
        </tr>
    </table>
  </div>  	
	
  <input type="hidden" value="{{ $proveedor->porcentaje }}" id="porcentaje">

	<a href="{{ route('reportesislr.edit', $reportesislr->id) }}" class="col-xs-6 col-sm-6 btn btn-warning"><i class="fa fa-edit fa-fw"></i> Editar comprovante</a>
  <br>
  <hr>
  <!--logica para mostrar el modal -->
  @if($proveedor->tipo == 'empleado')
    <!--Primer modal -->
    <button class="col-xs-6 col-sm-6 btn btn-success" data-toggle="modal" data-target="#myModal">
      <i class="fa fa-plus fa-fw"></i> Agregar pago
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            <h4 class="modal-title" id="myModalLabel">Agregar pago</h4>
          </div>
          <div class="modal-body">
            @include('facturasislr.formEmpleado')
          </div>
        </div>
      </div>
    </div>
    <!--Fin Primer modal -->

    <!--Show Pagos-->
    <br>
    <br>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-responsive">
        <tr>
            <th>#</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Nº Código</th> 
            <th class="text-center">Nº Comprobante</th>          
            <th class="text-center">Total</th>  
            <th class="text-center">C. O. Retenido</th>
            <th class="text-center">% Retenido</th>
            <th class="text-center">Total Impuesto Retenido</th>         
            <th class="text-center">Acciones</th>
        </tr>
        <?php 
          $totalc = 0;
          $totalob = 0;
          $totalbi = 0;
          $totaliva = 0;
          $totalr = 0;
        ?>
        @foreach ($items as $item)
        <tr>
            <td>{{ $contador += 1 }}</td>
            <td class="text-center">{{ date("d/m/Y", strtotime($item->fecha_fac)) }}</td>
            <td class="text-center">{{ $item->n_codigo }}</td>          
            <td class="text-center">{{ $item->n_comp }}</td>
            <td class="text-center">{{ number_format($item->total_compra,2,",",".") }}</td><?php $subtotal = $item->total_compra; ?> 
            <td class="text-center">{{ number_format($item->objreten,2,",",".") }}</td><?php $subtotalob = $item->objreten; ?>  
            <td class="text-center">{{ number_format($item->iva,2,",",".") }}</td>
            <td class="text-center">{{ number_format($item->impuesto_iva,2,",",".") }}</td><?php $subtotaliva = $item->impuesto_iva; ?>          
            <td class="text-center">
             <a href="{{ route('facturasislr.edit', $item->id) }}" class="btn btn-warning btn-xs"> Editar</a>
            </td>
        </tr>
        <?php 
          $totalc += $subtotal;
          $totaliva += $subtotaliva;
          $totalob += $subtotalob;
        ?>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>  
            <td><strong>Totales</strong></td>  
            <td class="text-center"><strong>{{ number_format($totalc,2,",",".") }}</strong></td>   
            <td class="text-center"><strong>{{ number_format($totalob,2,",",".") }}</strong></td>           
            <td></td>
            <td class="text-center"><strong>{{ number_format($totaliva,2,",",".") }}</strong></td>          
            <td></td>
        </tr>     
      </table>
    </div> 
    <a href="{{ route('pdf-islr', $reportesislr->id) }}" target="_blank" class="col-xs-6 col-sm-6 btn btn-info"><i class="fa fa-file-pdf-o"></i> Generar Reporte</a>
    <!--Fin Show Pagos-->
  @else
  <!--Segundo modal -->
  <button class="col-xs-6 col-sm-6 btn btn-success" data-toggle="modal" data-target="#myModal1">
      <i class="fa fa-plus fa-fw"></i> Agregar factura
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            <h4 class="modal-title" id="myModalLabel">Agregar factura</h4>
          </div>
          <div class="modal-body">
            @include('facturasislr.formProveedor')
          </div>
        </div>
      </div>
    </div>
    <!--Fin Segundo modal -->
    
    <!--Show Facturas-->
    <br>
    <br>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-responsive">
        <tr>
            <th>#</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Factura</th>  
            <th class="text-center">Nº Control</th> 
            <th class="text-center">Nº Comprobante</th>          
            <th class="text-center">Total</th>           
            <th class="text-center">C. O. Retenido</th>
            <th class="text-center">% Retenido</th>
            <th class="text-center">Total Impuesto Retenido</th>         
            <th class="text-center">Acciones</th>
        </tr>
        <?php $cont = 0;?>
        <?php $totalc = 0;?>
        <?php $totalob = 0;?>
        <?php $totalbi = 0;?>
        <?php $totaliva = 0;?>
        <?php $totalr = 0;?>
        @foreach ($items as $item)
        <tr>
            <td>{{ $cont += 1 }}</td>
            <td class="text-center">{{ date("d/m/Y", strtotime($item->fecha_fac)) }}</td>
            <td class="text-uppercase">{{ $item->n_factura }}</td>          
            <td class="text-center">{{ $item->n_control }}</td>
            <td class="text-center">{{ $reportesislr->n_comp }}</td>
            <td class="text-center">{{ number_format($item->total_compra,2,",",".") }}</td><?php $subtotal = $item->total_compra; ?>   
            <td class="text-center">{{ number_format($item->base_imp,2,",",".") }}</td><?php $subtotalbi = $item->base_imp; ?>
            <td class="text-center">{{ number_format($item->iva,2,",",".") }}</td>
            <td class="text-center">{{ number_format($item->impuesto_iva,2,",",".") }}</td><?php $subtotaliva = $item->impuesto_iva; ?>          
            <td class="text-center">
             <a href="{{ route('facturasislr.edit', $item->id) }}" class="btn btn-warning btn-xs"> Editar</a>
            </td>
        </tr>
        <?php $totalc += $subtotal;?>
        <?php $totalbi += $subtotalbi;?>
        <?php $totaliva += $subtotaliva;?>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td> 
            <td></td>  
            <td><strong>Totales</strong></td>  
            <td class="text-center"><strong>{{ number_format($totalc,2,",",".") }}</strong></td>            
            <td class="text-center"><strong>{{ number_format($totalbi,2,",",".") }}</strong></td>
            <td></td>
            <td class="text-center"><strong>{{ number_format($totaliva,2,",",".") }}</strong></td>          
            <td class="text-center"></td>
        </tr>     
      </table>
    </div> 
    <a href="{{ route('pdf-islr', $reportesislr->id) }}" target="_blank" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Generar Reporte</a>
    <!--Fin Show Facturas-->
  @endif  
@stop
