@extends('master.layout')

<?php
  $form_data = array('route' => array('reportesislr.update', $reportesislr->id), 'method' => 'PATCH');
  $action    = 'Actualizar';    
?>
@section ('title') {{ $action }} reporte I.S.L.R. | App-Retenciones @stop
@section('content')

  <legend><h3 class="form-signin-heading"><i class="fa fa-edit fa-fw"></i> {{ $action }} reporte I.S.L.R.</h3></legend>
  <ul class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">Inicio</a></li>
    <li><a href="{{ route('reportesislr.index') }}">Lista de Retenciones I.S.L.R.</a></li>
    <li class="active">{{ $action }} reporte I.S.L.R.</li>
  </ul>

  @include ('admin/errors', array('errors' => $errors))

  {{ Form::model($reportesislr, $form_data, array('role' => 'form')) }}
    
    <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
 
    {{ Form::label('n_comp', 'Nº Comprobante:') }}
    <div class="row">
      <div class="col-md-4">        
        <input type="text" name="n_comp" class="form-control" value="{{ $reportesislr->n_comp }}">
        <input type="hidden" name="secuencia" class="form-control" placeholder="Nombre de la empresa" value="{{ $reportesislr->n_comp }}">    
      </div>
    </div>
    {{ Form::label('fecha', 'Fecha:') }}
    <div class="row">
      <div class="col-md-4">
        {{ Form::input('date', 'fecha', null, array('class' => 'form-control', 'placeholder' => 'Date', 'autofocus'=>'autofocus')) }}
      </div>
    </div>
    {{ Form::label('periodo', 'Periodo:') }}
    <div class="row">
      <div class="col-md-4">
        <input type="month" name="periodo" class="form-control" value="{{ $reportesislr->periodo }}">
      </div>
    </div>
    {{ Form::label('id_agente', 'Agente de retención:') }}
    <div class="row">
      <div class="col-md-7">
        <input type="text" name="agente" value="{{ $agente->nombre }}" class="form-control" readonly>
        <input type="hidden" name="id_agente" value="{{ $agente->id }}">
      </div>
    </div>   
    {{ Form::label('id_empleado', 'Proveedor o Empleado:') }}
    <div class="row">
      <div class="col-md-7">
        <select class="form-control" name="id_empleado" id="proveedor" readonly required>
          <option value="{{ $reportesislr->id_empleado }}">Seleccione</option>
          @foreach($empleados as $empleado)
            <option value="{{ $empleado->id }}"> {{ $empleado->nombre }} </option>
          @endforeach   
        </select>
      </div>
    </div>

     <div class="checkbox">
       <label>
        <input type="checkbox" id="casilla2" value="1" onclick="desactivar()" checked="checked"> Editar empleado o proveedor
      </label> 
    </div>

    <br>     
   
    {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' reporte I.S.L.R.', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}

  {{ Form::close() }}

  {{ Form::model($reportesislr, array('route' => array('reportesislr.destroy', $reportesislr->id), 'method' => 'DELETE', 'role' => 'form')) }}
    {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar reporte I.S.L.R.', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
  {{ Form::close() }}
 
  @section('script')
    <script>
      function desactivar() {
        
        if($("#casilla2:checked").val()==1) {
          $("#proveedor").attr('readonly', 'readonly');
        }
        else {
          $("#proveedor").removeAttr("readonly");
        }
      }
    </script>
  @stop
@stop