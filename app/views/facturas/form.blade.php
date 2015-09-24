<div>
  <div class="load_ajax"></div>
  <div class="bg-danger"><h3 class="errors_form"></h3></div>  
</div>  
<div class="form">
  {{ Form::open(array('url' => 'facturas-iva-create', 'class' => 'create_factura_iva')) }}   
   
    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
    <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    <input type="hidden" name="id_reporte" value="{{ $reportes->id }}">
    <input type="hidden" name="id_proveedor" value="{{ $reportes->id }}">

    <div class="row">
      <input type="hidden" name="n_comp" value="{{ $reportes->n_comp }}">
      <div class="col-md-4">
        {{ Form::label('fecha_fac', 'Fecha Factura:') }}
        {{ Form::input('date', 'fecha_fac', null, array('class' => 'form-control', 'placeholder' => 'Date', 'autofocus'=>'autofocus', 'required')) }}
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
          ), null, ['class' => 'form-control', 'required'])
        }}
      </div>
      <div class="col-md-4">
        {{ Form::label('n_fact_ajustada', 'Nº Factura Ajustada:') }} 
        {{ Form::text('n_fact_ajustada', null, array('class' => 'form-control', 'placeholder' =>'Número de factura ajustada')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('total_compra', 'Total Compras:') }} 
        {{ Form::text('total_compra', null, array('class' => 'form-control', 'placeholder' =>'Total compras incluyendo IVA', 'id' => 'total1', 'onkeyup' => 'calcular(1)', 'required')) }}
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
        <input type="text" name="iva" class="form-control" id="iva1" onkeyup="calcular(1)" readonly value="{{ $iva->iva }}">
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
    <p>     
      {{ Form::button('<i class="fa fa-plus fa-fw"></i> ' . 'Agregar factura', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success', 'id' => 'frm_iva')) }}
      {{ Form::close() }}
      <br>
    </p>
    
</div>