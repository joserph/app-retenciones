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
  @else
  <!--Segundo modal -->
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
    <!--Fin Segundo modal -->
  @endif  
@stop
