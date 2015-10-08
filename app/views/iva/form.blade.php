@extends('master.layout')

<?php
    if ($iva->exists):
        $form_data = array('route' => array('iva.update', $iva->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'iva.store', 'method' => 'POST');
        $action    = 'Agregar';        
    endif;
?>
@section ('title') {{ $action }} impuesto I.V.A. | App-Retenciones @stop
@section('content')
  
	
  <legend><h3 class="form-signin-heading"><i class="fa fa-edit fa-fw"></i> {{ $action }} I.V.A.</h3></legend>
  <ul class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">Inicio</a></li>
    <li><a href="{{ route('iva.index') }}">Impuesto I.V.A.</a></li>
    <li class="active">{{ $action }} impuesto I.V.A.</li>
  </ul> 
  @include ('admin/errors', array('errors' => $errors))
  {{ Form::model($iva, $form_data, array('role' => 'form')) }} 
    @if($action == "Agregar")
      <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @else 
      <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    @endif
    
    {{ Form::label('iva', 'Porcentaje IVA:') }}
    <div class="form-group">
      <div class="input-group col-md-2">
        {{ Form::text('iva', null, array('class' => 'form-control', 'placeholder' =>'I.V.A.')) }}<div class="input-group-addon">%</div>
      </div>
    </div>
    {{ Form::label('estatus', 'Estatus:') }}
    <div class="row">
      <div class="col-md-3"> 
        {{ Form::select('estatus', array(
          '' => 'Select',
          'vencido' => 'Vencido',
          'actual' => 'Actual'
          ), null, ['class' => 'form-control'])
        }} 
      </div>
    </div>

    {{ Form::label('vigencia', 'Vigencia:') }}
    <div class="row">
      <div class="col-md-4">  
        {{ Form::input('date', 'vigencia', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa')) }}
      </div>
    </div>      
    <br>     
    @if($action == 'Agregar')
      {{ Form::button('<i class="fa fa-plus-circle fa-fw"></i> ' . $action.' I.V.A.', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
    @else 
      {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action.' I.V.A.', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}
    @endif
   
  {{ Form::close() }}

  @if ($action == 'Editar')  
    {{ Form::model($iva, array('route' => array('iva.destroy', $iva->id), 'method' => 'DELETE', 'role' => 'form')) }}        
        {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar I.V.A.', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
    {{ Form::close() }}
  @endif


@stop