@extends('master.layout')

<?php
  $form_data = array('route' => array('reportes.update', $reportes->id), 'method' => 'PATCH');
  $action    = 'Editar';    
?>
@section ('title') {{ $action }} reporte | App-Retenciones @stop

@section('content')
  
	{{ Form::model($reportes, $form_data, array('role' => 'form')) }}

  <legend><h3 class="form-signin-heading">{{ $action }} reporte</h3></legend>

  <ul class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">Inicio</a></li>
    <li><a href="{{ route('reportes.index') }}">Lista de Retenciones IVA</a></li>
    <li class="active">{{ $action }} reporte IVA</li>
  </ul>
  @include ('admin/errors', array('errors' => $errors))    

  <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    
  {{ Form::label('n_comp', 'Nº Comprobante:') }}
    <div class="row">
      <div class="col-md-4">        
        <input type="text" name="n_comp" class="form-control" placeholder="Nombre de la empresa" value="{{ $reportes->n_comp }}"> 
        <input type="hidden" name="secuencia" value="{{ substr("$reportes->n_comp", 6)}}">        
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
        <input type="month" name="periodo" class="form-control" value="{{ $reportes->periodo }}">
      </div>
    </div>

  {{ Form::label('id_agente', 'Agente de Retención:') }}
    <div class="row">
      <div class="col-md-4">
        <input type="text" name="agente" class="form-control" value="{{ $agente->nombre }}" disabled>
        <input type="hidden" name="id_agente" value="{{ $agente->id }}">
      </div>
    </div>

  {{ Form::label('id_proveedor', 'Proveedor:') }}
    <select class="form-control input-sm" name="id_proveedor" id="proveedor" disabled required>
      @foreach($proveedores as $proveedor)
        <option value=" {{ $proveedor->id }} ">{{ $proveedor->nombre }}</option>
      @endforeach   
    </select>

    <div class="checkbox">
       <label>
        <input type="checkbox" id="casilla2" value="1" onclick="desactivar()" checked="checked"> Editar proveedor
      </label> 
    </div>
    
    <br>     
  
  {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' reporte', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}
   
   
  {{ Form::close() }}
  
  @if ($action == 'Editar')  
    {{ Form::model($reportes, array('route' => array('reportes.destroy', $reportes->id), 'method' => 'DELETE', 'role' => 'form')) }}    
        {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar reporte', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
    {{ Form::close() }}
  @endif
  @section('script')
    <script>
      function desactivar() {
        
        if($("#casilla2:checked").val()==1) {
          $("#proveedor").attr('disabled', 'disabled');
        }
        else {
          $("#proveedor").removeAttr("disabled");
        }
      }
    </script>
  @stop
@stop