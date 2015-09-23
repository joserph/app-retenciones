@extends('master.layout')
<?php
    if ($agente->exists):
        $form_data = array('route' => array('agente.update', $agente->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'agente.store', 'method' => 'POST');
        $action    = 'Agregar';        
    endif;
?>
@section ('title') {{ $action }} agente de retención | App-Retenciones @stop
@section('content')

  <legend><h3 class="form-signin-heading"><i class="fa fa-edit fa-fw"></i> {{ $action }} agente de retención</h3></legend> 

   <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li><a href="{{ route('agente.index') }}">Agente de Retención</a></li>
        <li class="active">{{ $action }} agente de retención</li>
    </ul>  

  @include ('admin/errors', array('errors' => $errors))

	{{ Form::model($agente, $form_data, array('role' => 'form')) }}   
    
    @if($action == "Agregar")
      <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @else 
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @endif
    
    {{ Form::label('nombre', 'Nombre:') }}
    <div class="row">
      <div class="col-xs-12">
        {{ Form::text('nombre', null, array('class' => 'form-control', 'placeholder' =>'Nombre de la empresa', 'autofocus'=>'autofocus')) }}
      </div>
    </div>
    
    {{ Form::label('rif', 'RIF:') }}
    <div class="row">
      <div class="col-xs-4">
        {{ Form::text('rif', null, array('class' => 'form-control', 'placeholder' =>'RIF de la empresa')) }} 
        <p>Ej. <strong>J-12345678-9</strong></p>
      </div>
    </div>
    
      {{ Form::label('direccion', 'Dirección:') }}
    <div class="row">
      <div class="col-xs-12">
      {{ Form::text('direccion', null, array('class' => 'form-control', 'placeholder' =>'Dirección de la empresa')) }}
      </div>
    </div>
    
      {{ Form::label('tlf', 'Teléfono:') }}
    <div class="row">
      <div class="col-xs-4">
      {{ Form::text('tlf', null, array('class' => 'form-control', 'placeholder' =>'Teléfono de la empresa')) }}
      <p>Ej. <strong>0212-9876543</strong></p>
      </div>  
    </div>
      {{ Form::label('comp', 'Secuencia IVA:') }}
    <div class="row">
      <div class="col-xs-4">
      {{ Form::text('comp', null, array('class' => 'form-control', 'placeholder' =>'Secuencia de comprobante IVA')) }}
      <p>Ej. <strong>00000012</strong></p>
      </div>
    </div>
    
      {{ Form::label('compislr', 'Secuencia ISLR:') }}
    <div class="row">
      <div class="col-xs-4">
      {{ Form::text('compislr', null, array('class' => 'form-control', 'placeholder' =>'Secuencia de comprobante ISLR')) }}
      <p>Ej. <strong>22</strong></p>
      </div>
    </div>
    
    <br>     
    @if($action == 'Agregar')
      {{ Form::button('<i class="fa fa-plus fa-fw"></i> ' . $action . ' agente', array('type' => 'submit', 'class' => 'btn btn-success col-xs-6 col-sm-6')) }}
    @else 
      {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' agente', array('type' => 'submit', 'class' => 'btn btn-warning col-xs-6 col-sm-6')) }}
    @endif
   
  {{ Form::close() }}
  
@stop