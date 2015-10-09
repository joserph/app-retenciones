@extends('master.layout')
<?php
  if ($ventas->exists):
    $form_data = array('route' => array('ventas.update', $ventas->id), 'method' => 'PATCH');
    $action    = 'Editar';
  else:
    $form_data = array('route' => 'ventas.store', 'method' => 'POST');
    $action    = 'Agregar';        
  endif;
?>
@section ('title') {{ $action }} venta | App-Retenciones @stop
@section('content')
  
	{{ Form::model($ventas, $form_data, array('role' => 'form')) }}
  <legend><h3 class="form-signin-heading"><i class="fa fa-edit fa-fw"></i> {{ $action }} venta</h3></legend>
    <ul class="breadcrumb">
      <li><a href="{{ URL::route('home') }}">Inicio</a></li>
      <li><a href="{{ route('ventas.index') }}">Ventas de {{ $agente->nombre }}</a></li>
      <li class="active">{{ $action }} venta</li>
    </ul>
    @include ('admin/errors', array('errors' => $errors))
    @if($action == "Agregar")
      <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @else 
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @endif
    
    {{ Form::label('fecha_z', 'Fecha de la venta:') }}
    <div class="row">
      <div class="col-md-4"> 
        {{ Form::input('date', 'fecha_z', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'autofocus'=>'autofocus')) }} 
      </div>
    </div>
    <br>     
    @if($action == 'Agregar')
      {{ Form::button('<i class="fa fa-plus-circle fa-fw"></i> ' . $action . ' venta', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
    @else 
      {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' venta', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}
    @endif
   
  {{ Form::close() }}
  @if($action == "Editar")
    {{ Form::model($ventas, array('route' => array('ventas.destroy', $ventas->id), 'method' => 'DELETE', 'role' => 'form')) }}        
      {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar venta', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
    {{ Form::close() }}
  @endif
@stop