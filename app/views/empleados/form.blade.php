@extends('master.layout')
<?php
  if ($empleados->exists):
    $form_data = array('route' => array('empleados.update', $empleados->id), 'method' => 'PATCH');
    $action    = 'Actualizar';
  else:
    $form_data = array('route' => 'empleados.store', 'method' => 'POST');
    $action    = 'Agregar';        
  endif;
?>
@section ('title') {{ $action }} empleado o proveedor I.S.L.R. | App-Retenciones @stop
@section('content')


	
  <legend><h3 class="form-signin-heading"><i class="fa fa-edit fa-fw"></i> {{ $action }} empleado o proveedor I.S.L.R.</h3></legend>
  <ul class="breadcrumb">
      <li><a href="{{ URL::route('home') }}">Inicio</a></li>
      <li><a href="{{ route('empleados.index') }}">Lista de Empleados y Proveedores I.S.L.R.</a></li>
      <li class="active">{{ $action }} empleado o proveedor</li>
  </ul>

  @include ('admin/errors', array('errors' => $errors))

  {{ Form::model($empleados, $form_data, array('role' => 'form')) }}
    @if($action == "Agregar")
      <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @else 
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @endif
    {{ Form::label('tipo', 'Tipo:') }}
    <div class="row">
      <div class="col-md-2">
        {{ Form::select('tipo', array(
          '' => 'Seleccionar',
          'proveedor' => 'Proveedor',
          'empleado' => 'Empleado'
          ), null, ['class' => 'form-control', 'autofocus'=>'autofocus'])
        }}
      </div>
    </div>
    {{ Form::label('nombre', 'Nombre:') }}
    <div class="row">
      <div class="col-md-12"> 
        {{ Form::text('nombre', null, array('class' => 'form-control', 'placeholder' =>'Nombre del empleado o proveedor')) }}
      </div>
    </div>
    {{ Form::label('rif', 'RIF:') }}
    <div class="row">
      <div class="col-md-4">
        {{ Form::text('rif', null, array('class' => 'form-control', 'placeholder' =>'RIF del empleado o proveedor')) }}
      </div>
    </div>
    {{ Form::label('direccion', 'Dirección:') }}
    <div class="row">
      <div class="col-md-12">
        {{ Form::text('direccion', null, array('class' => 'form-control', 'placeholder' =>'Dirección del empleado o proveedor')) }}
      </div>
    </div>
    {{ Form::label('tlf', 'Tlf:') }}
    <div class="row">
      <div class="col-md-4">
        {{ Form::text('tlf', null, array('class' => 'form-control', 'placeholder' =>'Teléfono del empleado o proveedor. Ej. 02121234567')) }}
      </div>
    </div>
    {{ Form::label('porcentaje', 'Porcentaje retención:') }}
    <div class="form-group">
      <div class="input-group col-md-2">
        {{ Form::text('porcentaje', null, array('class' => 'form-control', 'placeholder' =>'Porcentaje')) }}<div class="input-group-addon">%</div>
      </div>
    </div>    
    <br>     
    @if($action == 'Agregar')
      {{ Form::button('<i class="fa fa-plus fa-fw"></i> ' . $action . ' empleado', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
    @else
      @if($empleados->tipo == "empleado")
        {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' empleado', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}
      @else
        {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' proveedor', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}
      @endif
    @endif
   
  {{ Form::close() }}
  
  @if ($action == 'Actualizar')
    @if($empleados->tipo == "empleado") 
      {{ Form::model($empleados, array('route' => array('empleados.destroy', $empleados->id), 'method' => 'DELETE', 'role' => 'form')) }}    
          {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar empleado', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
      {{ Form::close() }}
    @else 
      {{ Form::model($empleados, array('route' => array('empleados.destroy', $empleados->id), 'method' => 'DELETE', 'role' => 'form')) }}    
          {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar proveedor', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
      {{ Form::close() }}
    @endif
  @endif
@stop