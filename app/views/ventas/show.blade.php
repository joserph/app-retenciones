@extends ('master.layout')
@section ('title') Fecha de venta: {{ date('d/m/Y', strtotime($ventas->fecha_z)) }} | App-Retenciones @stop
@section ('content')

   	<legend><h3><i class="fa fa-calendar fa-fw"></i> Fecha de venta: {{ date('d/m/Y', strtotime($ventas->fecha_z)) }}</h3></legend>
   	<ul class="breadcrumb">
      <li><a href="{{ URL::route('home') }}">Inicio</a></li>
      <li><a href="{{ route('ventas.index') }}">Ventas de {{ $agente->nombre }}</a></li>
      <li class="active">Fecha de venta: {{ date('d/m/Y', strtotime($ventas->fecha_z)) }}</li>
    </ul>

    <div class="table-responsive">
      <table class="table table-bordered table-responsive">
          <tr>
              <td class="active text-center"><strong>Fecha de venta</strong></td>                    
          </tr>
           <tr>
              <td class="text-center text-capitalize info">{{ date('d/m/Y', strtotime($ventas->fecha_z)) }}</td>                   
          </tr>
      </table>
    </div>

  	<a href="{{ route('ventas.edit', $ventas->id) }}" class="col-xs-6 col-sm-6 btn btn-warning"><i class="fa fa-edit fa-fw"></i> Editar fecha</a>
    <br>
  	<hr>
<!-- Large modal -->
<!-- Button trigger modal -->
  <button class="col-xs-6 col-sm-6 btn btn-success" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-plus-circle fa-fw"></i> Agregar reporte de venta
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h3 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle fa-fw"></i> Agregar reporte de venta</h3>
        </div>
        <div class="modal-body">
          @include('reportesventas.form')
        </div>
      </div>
    </div>
  </div>
<!-- Fin Large modal -->
  @if($ventasCount > 0)
    <br><br>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-responsive">
        <tr>
            <th>#</th>
            <th class="text-center">Número de venta</th>
            <th class="text-center">Total Venta</th>
            <th class="text-center">Total Tributados</th>  
            <th class="text-center">Exento</th>
            <th class="text-center">Impuesto</th>
            <th class="text-center">Acciones</th>
        </tr>
        <?php 
          $totalV = 0;
          $totalT = 0;
          $totalEx = 0;
          $totalIm = 0;
        ?>
        
        @foreach ($reportesVentas as $item)
        <tr>
            <td>{{ $contador += 1 }}</td>
            <td class="text-center">{{ $item->n_zetas }}</td>
            <td class="text-center">{{ number_format($item->total_v,2,",",".") }}</td><?php $subtotal = $item->total_v; ?>
            <td class="text-center">{{ number_format($item->tributado,2,",",".") }}</td><?php $subtotaltr = $item->tributado; ?>
            <td class="text-center">{{ number_format($item->exento,2,",",".") }}</td><?php $subtotalex = $item->exento; ?>
            <td class="text-center">{{ number_format($item->impuesto,2,",",".") }}</td><?php $subtotaliva = $item->impuesto; ?>
            <td class="text-center">
              <a href="{{ route('reportesventas.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a>
            </td>
        </tr>
        <?php 
          $totalV += $subtotal;
          $totalT += $subtotaltr;
          $totalEx += $subtotalex;
          $totalIm += $subtotaliva;
        ?>
        @endforeach
        <tr>
          <td></td>
          <td><strong>Total:</strong></td>
          <td class="text-center"><strong>{{ number_format($totalV,2,",",".") }}</strong></td>
          <td class="text-center"><strong>{{ number_format($totalT,2,",",".") }}</strong></td>
          <td class="text-center"><strong>{{ number_format($totalEx,2,",",".") }}</strong></td>
          <td class="text-center"><strong>{{ number_format($totalIm,2,",",".") }}</strong></td>
          <td></td>
        </tr>     
      </table>
    </div>
  @endif 
@stop
