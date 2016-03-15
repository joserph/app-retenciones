@extends('master.layout')
<?php
  $form_data = array('route' => 'islr-reportes.store', 'method' => 'POST');
  $action    = 'Crear';        
?>
@section ('title') {{ $action }} reporte I.S.L.R. | App-Retenciones @stop
@section('content')

  <legend><h3><i class="fa fa-plus-circle fa-fw"></i> {{ $action }} reporte I.S.L.R.</h3></legend>
  <ul class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">Inicio</a></li>
    <li><a href="{{ route('islr-reportes.index') }}">Lista de Retenciones I.S.L.R.</a></li>
    <li class="active">{{ $action }} reporte I.S.L.R.</li>
  </ul>

  @include ('admin/errors', array('errors' => $errors))

  {{ Form::model($reportesislr, $form_data, array('role' => 'form')) }}
    
    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
    <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    
    {{ Form::label('n_comp', 'Nº Comprobante:') }}
    <div class="row">
      <div class="col-md-4">        
        <input type="text" name="n_comp" class="form-control" placeholder="Nombre de la empresa" autofocus value="{{ $ultimo }}">
        <input type="hidden" name="secuencia" class="form-control" placeholder="Nombre de la empresa" value="{{ $ultimo }}">         
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
    <div class="row">
      <div class="col-md-7">
        <input type="text" name="agente" value="{{ $agente->nombre }}" class="form-control" readonly>
        <input type="hidden" name="id_agente" value="{{ $agente->id }}">
      </div>
    </div>   
    {{ Form::label('id_empleado', 'Proveedor o Empleado:') }}
    <div class="row">
      <div class="col-md-7">
        {{ Form::select('id_empleado', ($empleados = array('' => 'Seleccionar proveedor o empleado') + $empleados), null, ['class' => 'form-control']) }} 
      </div>
    </div>

    <br>   
    
    {{ Form::button('<i class="fa fa-plus-circle fa-fw"></i> ' . $action . ' reporte I.S.L.R.', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
   
  {{ Form::close() }}
@stop