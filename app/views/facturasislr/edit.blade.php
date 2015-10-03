@extends('master.layout')
<?php
  $form_data = array('route' => array('facturasislr.update', $facturasislr->id), 'method' => 'PATCH');
  $action    = 'Editar';
?>
@section ('title')
  @if($facturasislr->tipo == 'proveedor')
    {{ $action }} factura | App-Retenciones 
  @else
    {{ $action }} pago | App-Retenciones 
  @endif
@stop
@section('content')
<legend>
  @if($facturasislr->tipo == 'proveedor')
    <h3 class="form-signin-heading"><i class="fa fa-edit fa-fw"></i> {{ $action }} factura</h3>
  @else
    <h3 class="form-signin-heading"><i class="fa fa-edit fa-fw"></i> {{ $action }} pago</h3>
  @endif
</legend>
  <ul class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">Inicio</a></li>
    <li><a href="{{ route('facturasislr.index') }}">Lista de sueldos y factuas I.S.L.R.</a></li>
    <li class="active">
      @if($facturasislr->tipo == 'proveedor')
        {{ $action }} factura</li>
      @else
        {{ $action }} pago</li>
      @endif
  </ul>
  @include ('admin/errors', array('errors' => $errors))
@if($facturasislr->tipo == 'proveedor')
	{{ Form::model($facturasislr, $form_data, array('role' => 'form')) }}      
    <input type="hidden" name="tipo" value="{{ $proveedor->tipo }}">
    <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">      
    <div class="row">
      <div class="col-md-4">
        {{ Form::label('fecha_fac', 'Fecha Factura:') }}
        {{ Form::input('date', 'fecha_fac', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'autofocus'=>'autofocus', 'required')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('n_factura', 'Nº Factura:') }} 
        {{ Form::text('n_factura', null, array('class' => 'form-control', 'placeholder' =>'Número de factura')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('n_control', 'Nº Control:') }} 
        {{ Form::text('n_control', null, array('class' => 'form-control', 'placeholder' =>'Número de control', 'required')) }}
      </div>        
      <div class="col-md-4">
        {{ Form::label('total_compra', 'Total Factura:') }} 
        {{ Form::text('total_compra', null, array('class' => 'form-control', 'placeholder' =>'Total compras incluyendo IVA', 'id' => 'total1', 'onkeyup' => 'calcular(1)', 'required')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('base_imp', 'Cantidad Objeto Retenido:') }} 
        {{ Form::text('base_imp', null, array('class' => 'form-control', 'id' => 'base_imp1', 'onkeyup' => 'calcular(1)', 'required')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('iva', 'Impuesto:') }} 
        <input type="text" name="iva" class="form-control" id="iva1" onkeyup="calcular(1)" readonly required value="{{ $facturasislr->iva }} ">
      </div>
      <div class="col-md-4">
        {{ Form::label('impuesto_iva', 'Total Impuesto:') }} 
        {{ Form::text('impuesto_iva', null, array('class' => 'form-control', 'id' => 'impuesto1', 'onkeyup' => 'calcular(1)', 'required')) }}
      </div>
    </div>
    <br>
@else
  @include ('admin/errors', array('errors' => $errors))
  {{ Form::model($facturasislr, $form_data, array('role' => 'form')) }}          
    <input type="hidden" name="tipo" value="{{ $proveedor->tipo }}">    
    <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">    
    <div class="row">
      <div class="col-md-4">
        {{ Form::label('fecha_fac', 'Fecha Pago:') }}
        {{ Form::input('date', 'fecha_fac', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'autofocus'=>'autofocus', 'required')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('n_codigo', 'Nº Código:') }} 
        {{ Form::text('n_codigo', null, array('class' => 'form-control', 'placeholder' =>'Número de control', 'required')) }}
      </div>        
      <div class="col-md-4">
        {{ Form::label('total_compra', 'Cantidad Pago:') }} 
        {{ Form::text('total_compra', null, array('class' => 'form-control', 'placeholder' =>'Total compras incluyendo IVA', 'id' => 'total', 'onkeyup' => 'calcular2()', 'required')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('objreten', 'Cantidad Objeto Retenido:') }} 
        {{ Form::text('objreten', null, array('class' => 'form-control', 'id' => 'objreten', 'onkeyup' => 'calcular2()', 'required')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('iva', 'Impuesto:') }} 
        <input type="text" name="iva" class="form-control" id="iva" onkeyup="calcular2()" readonly required value="{{ $facturasislr->iva }} ">
      </div>
      <div class="col-md-4">
        {{ Form::label('impuesto_iva', 'Total Impuesto:') }} 
        {{ Form::text('impuesto_iva', null, array('class' => 'form-control', 'id' => 'impuesto', 'onkeyup' => 'calcular2()', 'required')) }}
      </div>
    </div>
    <br>
@endif
@if($facturasislr->tipo == 'proveedor')
  {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' factura', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}
@else
  {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' pago', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}
@endif
{{ Form::close() }}
@if($facturasislr->tipo == 'proveedor')
  {{ Form::model($facturasislr, array('route' => array('facturasislr.destroy', $facturasislr->id), 'method' => 'DELETE', 'role' => 'form')) }}    
      {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar factura', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
  {{ Form::close() }}
@else
  {{ Form::model($facturasislr, array('route' => array('facturasislr.destroy', $facturasislr->id), 'method' => 'DELETE', 'role' => 'form')) }}    
      {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar pago', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
  {{ Form::close() }}
@endif

@section('script')
  <script>
  function calcular2()
  {
    total = $('#total').val();
    if(total == '') total = 0;

    exento = $('#exento').val();
    if (exento == '')  exento = 0;

    objreten = (total)/1;
    $('#objreten').val((objreten).toFixed(2));

    objreten = $('#objreten').val();
    if (objreten == '')  objreten = 0;
    
    base_imp = $('#base_imp').val();
    if(base_imp == '') base_imp = 0;
    
    iva = $('#iva').val();

    impuesto = (objreten * iva)/100;
    $('#impuesto').val((impuesto).toFixed(2));

    impuesto = $('#impuesto').val();
    if(impuesto == '') impuesto = 0;

    porcentaje = $('#porcentaje').val();
    iva_retenido = (impuesto * porcentaje)/100;
    $('#iva_retenido').val((iva_retenido).toFixed(2));
  }
</script>

<script>
  function calcular(i)
  {
    total = $('#total'+i).val();
    if(total == '') total = 0;

    exento = $('#exento'+i).val();
    if (exento == '')  exento = 0;

    base_imp = (total)/1.12;
    $('#base_imp'+i).val((base_imp).toFixed(2));

    objreten = $('#objreten').val();
    if (objreten == '')  objreten = 0;
    
    base_imp = $('#base_imp'+i).val();
    if(base_imp == '') base_imp = 0;
    
    iva = $('#iva'+i).val();

    impuesto = (base_imp * iva)/100;
    $('#impuesto'+i).val((impuesto).toFixed(2));

    impuesto = $('#impuesto'+i).val();
    if(impuesto == '') impuesto = 0;

    porcentaje = $('#porcentaje').val();
    iva_retenido = (impuesto * porcentaje)/100;
    $('#iva_retenido'+i).val((iva_retenido).toFixed(2));    
  }
</script>
@stop
@stop