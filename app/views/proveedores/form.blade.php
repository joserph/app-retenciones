@extends('master.layout')
<?php
    if ($proveedores->exists):
        $form_data = array('route' => array('proveedores.update', $proveedores->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'proveedores.store', 'method' => 'POST');
        $action    = 'Agregar';        
    endif;
?>
@section ('title') {{ $action }} proveedor I.V.A. | App-Retenciones @stop
@section('content')
  @if($action == 'Agregar')
    <legend><h3><i class="fa fa-plus-circle fa-fw"></i> {{ $action }} proveedor I.V.A.</h3></legend>
  @else
    <legend><h3><i class="fa fa-edit fa-fw"></i> {{ $action }} proveedor I.V.A.</h3></legend>
  @endif
  <ul class="breadcrumb">
      <li><a href="{{ URL::route('home') }}">Inicio</a></li>
      <li><a href="{{ route('proveedores.index') }}">Lista de Proveedores I.V.A.</a></li>
      <li class="active">{{ $action }} proveedor I.V.A.</li>
  </ul>
     @include ('admin/errors', array('errors' => $errors))
  {{ Form::model($proveedores, $form_data, array('role' => 'form')) }}
    @if($action == "Agregar")
      <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @else 
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @endif
    
    {{ Form::label('nombre', 'Nombre:') }} 
    <div class="row">
      <div class="col-md-12"> 
        {{ Form::text('nombre', null, array('class' => 'form-control', 'placeholder' =>'Nombre del proveedor', 'autofocus'=>'autofocus')) }}
      </div>
    </div>
    {{ Form::label('rif', 'RIF:') }} 
    <div class="row">
      <div class="col-md-4"> 
        {{ Form::text('rif', null, array('class' => 'form-control', 'placeholder' =>'RIF del proveedor')) }}
      </div>
    </div>
    {{ Form::label('direccion', 'Dirección:') }}
    <div class="row">
      <div class="col-md-12"> 
        {{ Form::text('direccion', null, array('class' => 'form-control', 'placeholder' =>'Dirección del proveedor')) }}
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
      {{ Form::button('<i class="fa fa-plus-circle fa-fw"></i> ' . $action . ' proveedor', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
      <a href="http://contribuyente.seniat.gob.ve/BuscaRif/BuscaRif.jsp" class="btn btn-primary pull-right" target="_blank"><i class="fa fa-eye fa-fw"></i> Consultar R.I.F.</a>
    @else 
      {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' proveedor', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}
    @endif
   
  {{ Form::close() }}
  @if ($action == 'Editar')  
    {{ Form::model($proveedores, array('route' => array('proveedores.destroy', $proveedores->id), 'method' => 'DELETE', 'role' => 'form')) }}    
        {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar proveedor', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
    {{ Form::close() }}
  @endif
@stop