@extends('master.layout')
<?php
  $form_data = array('route' => array('reportesventas.update', $reportesVentas->id), 'method' => 'PATCH');
  $action    = 'Editar';
?>
@section ('title') {{ $action }} reporte de venta | App-Retenciones @stop
@section('content')

  @include ('admin/errors', array('errors' => $errors))

  <legend><h3 class="form-signin-heading">{{ $action }} reporte de venta</h3></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li><a href="{{ route('ventas.index') }}">Ventas de {{ $agente->nombre }}</a></li>
        <li><a href="{{ route('ventas.show', $reportesVentas->id_fecha) }}">Fecha de venta: {{ date('d/m/Y', strtotime($ventas->fecha_z)) }}</a></li>
        <li class="active">{{ $action }} reporte de venta</li>
    </ul>

	{{ Form::model($reportesVentas, $form_data, array('role' => 'form')) }} 

    <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">  
    
    <div class="row">
      <div class="col-md-4">
        {{ Form::label('n_zetas', 'Número de reporte:') }} 
        {{ Form::text('n_zetas', null, array('class' => 'form-control', 'placeholder' =>'Nº reporte zeta', 'autofocus', 'required')) }}
      </div>      
      <div class="col-md-4">
        {{ Form::label('total_v', 'Total Ventas:') }} 
        {{ Form::text('total_v', null, array('class' => 'form-control', 'placeholder' =>'Total ventas', 'id' => 'total_v1', 'onkeyup' => 'calcular(1)')) }}
      </div>      
      <div class="col-md-4">
        {{ Form::label('tributado', 'Tributado:') }} 
        {{ Form::text('tributado', null, array('class' => 'form-control', 'placeholder' =>'Monto tributados', 'required', 'id' => 'tributado1', 'onkeyup' => 'calcular(1)')) }}
      </div>   
      <div class="col-md-4">
        {{ Form::label('exento', 'Exento:') }} 
        {{ Form::text('exento', null, array('class' => 'form-control', 'placeholder' =>'Monto exentos', 'id' => 'exento1', 'onkeyup' => 'calcular(1)')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('impuesto', 'Impuesto:') }} 
        {{ Form::text('impuesto', null, array('class' => 'form-control', 'placeholder' =>'Monto impuesto', 'id' => 'impuesto1', 'onkeyup' => 'calcular(1)')) }}
      </div>      
    </div>    
    <br>
      {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' reporte', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}       

{{ Form::close() }}

  {{ Form::model($reportesVentas, array('route' => array('reportesventas.destroy', $reportesVentas->id), 'method' => 'DELETE', 'role' => 'form')) }}    
      {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar reporte', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
  {{ Form::close() }}

@section('script')
  <script>
  function calcular(i)
  {
    total = $('#total_v'+i).val();
    if(total == '') total = 0;

    tributado = $('#tributado'+i).val();
    if(tributado == '') tributado = 0;

    impuesto = (tributado * 12)/100;
    $('#impuesto'+i).val((impuesto).toFixed(2));

    impuesto = $('#impuesto'+i).val();
      if (impuesto == '') impuesto = 0;
  }
</script>
@stop
@stop