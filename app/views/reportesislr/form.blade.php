@extends('master.layout')

<?php
    if ($reportesislr->exists):
        $form_data = array('route' => array('reportesislr.update', $reportesislr->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'reportesislr.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;
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
    @if($action == "Crear")
      <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @else 
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @endif
    
    {{ Form::label('n_comp', 'Nº Comprobante:') }}
    <div class="row">
      <div class="col-md-4">
        @if($action == "Crear")
          <input type="text" name="n_comp" class="form-control" placeholder="Nombre de la empresa" autofocus value="{{ $ultimo }}">
          <input type="hidden" name="secuencia" class="form-control" placeholder="Nombre de la empresa" value="{{ $ultimo }}"> 
        @else
          <input type="text" name="n_comp" class="form-control" placeholder="Nombre de la empresa" value="{{ $reportesislr->n_comp }}"> 
          <input type="hidden" name="secuencia" class="form-control" placeholder="Nombre de la empresa" value="{{ substr("$reportesislr->n_comp", 6) }}"> 
        @endif
      </div>
    </div>
    {{ Form::label('fecha', 'Fecha:') }}
    <div class="row">
      <div class="col-md-4">
        {{ Form::input('date', 'fecha', null, array('class' => 'form-control', 'placeholder' => 'Date')) }}
      </div>
    </div>
    {{ Form::label('periodo', 'Periodo:') }}
    <div class="row">
      <div class="col-md-4">
        <input type="month" name="periodo" class="form-control" value="{{ $reportesislr->periodo }}">
      </div>
    </div>
    {{ Form::label('id_agente', 'Agente de retención:') }}
    <select class="form-control input-sm" name="id_agente" readonly>
      
        <option value=" {{ $agente->id }} "> {{ $agente->nombre }} </option>
       
    </select>    
    {{ Form::label('id_empleado', 'Proveedor o Empleado:') }}
    <select class="form-control input-sm" name="id_empleado">
      @foreach($empleados as $empleado)
        <option value=" {{ $empleado->id }} "> {{ $empleado->nombre }} </option>
      @endforeach   
    </select>

    <br>     
    @if($action == 'Crear')
      {{ Form::button('<i class="fa fa-plus fa-fw"></i> ' . $action . ' reporte I.S.L.R.', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
    @else 
      {{ Form::button($action.' reporte ISLR', array('type' => 'submit', 'class' => 'btn btn-warning')) }}
    @endif
   
  {{ Form::close() }}
  <p>
    @if ($action == 'Editar')  
      {{ Form::model($reportesislr, array('route' => array('reportesislr.destroy', $reportesislr->id), 'method' => 'DELETE', 'role' => 'form')) }}
        <div class="row">
          <div class="form-group col-md-4">
              {{ Form::submit('Eliminar reporte ISLR', array('class' => 'btn btn-danger')) }}
          </div>
        </div>
      {{ Form::close() }}
    @endif
  </p>

@stop