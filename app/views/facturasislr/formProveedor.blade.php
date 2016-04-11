<div>
  <div class="load_ajax"></div>
  <div><h3 class="errors_form"></h3></div>  
</div>  
<div class="form">
  {{ Form::open(array('url' => 'facturas-islr-create', 'class' => 'create_factura_islr')) }} 
    <input type="hidden" name="tipo" value="{{ $proveedor->tipo }}">  
    <input type="hidden" name="id_proveedor" value="{{ $proveedor->id }}">          
    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
    <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    <input type="hidden" name="id_reporteislr" value="{{ $reportesislr->id }}">
            
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
      <input type="hidden" name="n_comp" value="{{ $reportesislr->n_comp }}">    
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
        <input type="text" name="iva" class="form-control" id="iva1" onkeyup="calcular(1)" readonly required value="{{ $proveedor->porcentaje }} ">
      </div>
      <div class="col-md-4">
        {{ Form::label('impuesto_iva', 'Total Impuesto:') }} 
        {{ Form::text('impuesto_iva', null, array('class' => 'form-control', 'id' => 'impuesto1', 'onkeyup' => 'calcular(1)', 'required')) }}
      </div>
    </div>
</div>
    <br>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      {{ Form::button('<i class="fa fa-plus-circle fa-fw"></i> ' . 'Agregar factura', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
    </div>
  {{ Form::close() }}

@section('script')
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