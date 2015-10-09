@extends ('master.layout')
@section ('title')  | App-Retenciones @stop
@section ('content')

   	<legend><h3>Fecha de reporte Z: {{ date('d/m/Y', strtotime($ventas->fecha_z)) }}</h3></legend>
   	<ul class="breadcrumb">
      <li><a href="{{ URL::route('home') }}">Inicio</a></li>
      <li><a href="{{ route('ventas.index') }}">Ventas de {{ $agente->nombre }}</a></li>
      <li class="active">Fecha: {{ date('d/m/Y', strtotime($ventas->fecha_z)) }}</li>
    </ul>
	  <p>Fecha de reporte Z: <mark>{{ date('d/m/Y', strtotime($ventas->fecha_z)) }}</mark></p>
   
    <div class="row">
  		<div class="col-md-4">
  			<a href="{{ route('ventas.edit', $ventas->id) }}" class="btn btn-warning"> Editar</a>
  		</div>
	  </div>
    <br> 

<!-- Large modal -->
<!-- Button trigger modal -->
<button class="btn btn-success" data-toggle="modal" data-target="#myModal">
    Agregar Reporte Z
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title" id="myModalLabel">Agregar Reporte Z</h4>
        </div>
        <div class="modal-body">
          
        </div>
      </div>
    </div>
  </div>
<!-- Fin Large modal -->
  
	
  	
	
@stop
