@extends('master.layout')

<?php    
  $form_data = array('route' => 'reportes.store', 'method' => 'POST');
  $action    = 'Crear';            
?>
@section ('title') {{ $action }} reporte I.V.A. | App-Retenciones @stop
@section('content')

  <legend><h3><i class="fa fa-plus-circle fa-fw"></i> {{ $action }} reporte I.V.A.</h3></legend>

  <ul class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">Inicio</a></li>
    <li><a href="{{ route('reportes.index') }}">Lista de Retenciones I.V.A.</a></li>
    <li class="active">{{ $action }} reporte I.V.A.</li>
  </ul>
  
  @include ('admin/errors', array('errors' => $errors))

  {{ Form::model($reportes, $form_data, array('role' => 'form')) }} 
  <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
  <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    
  {{ Form::label('n_comp', 'Nº Comprobante:') }}
    <div class="row">
      <div class="col-md-4">        
        <input type="text" name="n_comp" class="form-control" placeholder="Nombre de la empresa" value="{{ $ultimo }}">
        <input type="hidden" name="secuencia" value="{{ substr("$ultimo", 6) }}"> 
      </div>
    </div>
  {{ Form::label('iva', 'I.V.A.:') }}    
    <div class="form-group">
      <div class="input-group col-md-1">
        <input type="text" name="iva" class="form-control" value="{{ $iva->iva }}" readonly><div class="input-group-addon">%</div>
      </div>
    </div>
  {{ Form::label('fecha', 'Fecha:') }}
    <div class="row">
      <div class="col-md-4">
        {{ Form::input('date', 'fecha', null, array('class' => 'form-control', 'placeholder' => 'Date', 'autofocus')) }}
      </div>
    </div>
  {{ Form::label('periodo', 'Periodo:') }}
    <div class="row">
      <div class="col-md-4">
        <input type="month" name="periodo" class="form-control" value="{{ $reportes->periodo }}">
      </div>
    </div>
  {{ Form::label('id_agente', 'Agente de Retención:') }}
    <div class="row">
      <div class="col-md-7">
        <input type="text" name="agente" class="form-control" value="{{ $agente->nombre }}" disabled>
        <input type="hidden" name="id_agente" value="{{ $agente->id }}">
      </div>
    </div>
  {{ Form::label('id_proveedor', 'Proveedor:') }}
    <div class="row">
      <div class="col-md-7">
      {{ Form::select('id_proveedor', ($proveedores = array('' => 'Seleccionar proveedor') + $proveedores), null, ['class' => 'form-control']) }}        
      </div>
    </div> 
  <br>     

  {{ Form::button('<i class="fa fa-plus-circle fa-fw"></i> ' . $action . ' reporte', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}

  {{ Form::close() }}

@stop