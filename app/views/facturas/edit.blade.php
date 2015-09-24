@extends('master.layout')
<?php    
  $form_data = array('route' => array('facturas.update', $facturas->id), 'method' => 'PATCH');
  $action    = 'Editar';    
?>
@section ('title') {{ $action }} factura I.V.A. | App-Retenciones @stop
@section('content')

@include ('admin/errors', array('errors' => $errors))

<legend><h3 class="form-signin-heading"><i class="fa fa-edit fa-fw"></i> {{ $action }} factura</h3></legend>
  <ul class="breadcrumb">
      <li><a href="{{ URL::route('home') }}">Inicio</a></li>
      <li><a href="{{ route('facturas.index') }}">Lista de Factuas I.V.A.</a></li>
      <li class="active">{{ $action }} factura I.V.A.</li>
  </ul>
  <input type="hidden" value="{{ $proveedor->porcentaje }}" id="porcentaje">
	{{ Form::model($facturas, $form_data, array('role' => 'form')) }}
            
  @if($action == "Crear")
    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
    <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    <input type="hidden" name="id_reporte" value="{{ $reportes->id }}">
  @else 
    <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
  @endif
  <div class="row">
    <div class="col-md-4">
      {{ Form::label('fecha_fac', 'Nº Comprobante:') }}
      {{ Form::input('date', 'fecha_fac', null, array('class' => 'form-control', 'placeholder' => 'Date', 'autofocus'=>'autofocus')) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('n_factura', 'Nº Factura:') }} 
      {{ Form::text('n_factura', null, array('class' => 'form-control', 'placeholder' =>'Número de factura', 'id' => 'n_factura1', 'onkeyup' => 'calcular(1)')) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('n_control', 'Nº Control:') }} 
      {{ Form::text('n_control', null, array('class' => 'form-control', 'placeholder' =>'Número de control', 'required', 'id' => 'n_control1', 'onkeyup' => 'calcular(1)')) }}
    </div>

    {{ Form::hidden('factura', null, array('class' => 'form-control', 'id' => 'factura1', 'onkeyup' => 'calcular(1)')) }}

    <div class="col-md-4">
      {{ Form::label('n_nota_debito', 'Nota de Débito:') }} 
      {{ Form::text('n_nota_debito', null, array('class' => 'form-control', 'placeholder' =>'Número nota de débito')) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('n_nota_credito', 'Nota de Crédito:') }} 
      {{ Form::text('n_nota_credito', null, array('class' => 'form-control', 'placeholder' =>'Número nota de crédito')) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('tipo_transa', 'Tipo de Transacción:') }} 
      {{ Form::select('tipo_transa', array(
        '' => 'Select',
        'compras' => 'Compras',
        'nota de credito' => 'Nota de Crédito',
        'nota de debito' => 'Nota de Débito'
        ), null, ['class' => 'form-control'])
      }}
    </div>
    <div class="col-md-4">
      {{ Form::label('n_fact_ajustada', 'Nº Factura Ajustada:') }} 
      {{ Form::text('n_fact_ajustada', null, array('class' => 'form-control', 'placeholder' =>'Número de factura ajustada')) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('total_compra', 'Total Compras:') }} 
      {{ Form::text('total_compra', null, array('class' => 'form-control', 'placeholder' =>'Total compras incluyendo IVA', 'id' => 'total1', 'onkeyup' => 'calcular(1)')) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('exento', 'Exento:') }} 
      {{ Form::text('exento', null, array('class' => 'form-control', 'placeholder' =>'Compras exentas de impuesto', 'id' => 'exento1', 'onkeyup' => 'calcular(1)')) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('base_imp', 'Base Imponible:') }} 
      {{ Form::text('base_imp', null, array('class' => 'form-control', 'id' => 'base_imp1', 'onkeyup' => 'calcular(1)')) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('iva', 'IVA:') }} 
      {{ Form::text('iva', '12', array('class' => 'form-control', 'id' => 'iva1', 'onkeyup' => 'calcular(1)', 'readonly')) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('impuesto_iva', 'Impuesto IVA:') }} 
      {{ Form::text('impuesto_iva', null, array('class' => 'form-control', 'id' => 'impuesto1', 'onkeyup' => 'calcular(1)')) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('iva_retenido', 'IVA Retenido:') }} 
      {{ Form::text('iva_retenido', null, array('class' => 'form-control', 'id' => 'iva_retenido1', 'onkeyup' => 'calcular(1)')) }}
    </div>
  </div>
    <br>   
    {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action.' factura', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}
  {{ Form::close() }}

  {{ Form::model($facturas, array('route' => array('facturas.destroy', $facturas->id), 'method' => 'DELETE', 'role' => 'form')) }}        
    {{ Form::button('<i class="fa fa-trash fa-fw"></i> ' . 'Eliminar factura', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-danger', 'onclick' => 'return confirm("Seguro de Eliminar?")')) }}
  {{ Form::close() }}
@section('script')
<script>
  function calcular(i)
  {
    guion = "-";
    n_factura = $('#n_factura'+i).val();
    if(n_factura == '') n_factura = 0;

    n_control = $('#n_control'+i).val();
    if(n_control == '') n_control = 0;

    factura = n_factura + guion + n_control;
    $('#factura'+i).val(factura);

    total = $('#total'+i).val();
    if(total == '') total = 0;

    exento = $('#exento'+i).val();
    if (exento == '')  exento = 0;

    base_imp = (total - exento)/1.12;
    $('#base_imp'+i).val((base_imp).toFixed(2));
    
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