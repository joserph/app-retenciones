<div>
  <div class="load_ajax"></div>
  <div class="bg-danger"><h3 class="errors_form"></h3></div>  
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
        {{ Form::label('fecha_fac', 'Fecha Pago:') }}
        {{ Form::input('date', 'fecha_fac', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'autofocus'=>'autofocus', 'required')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('n_codigo', 'Número de Código:') }}
        {{ Form::text('n_codigo', null, array('class' => 'form-control', 'placeholder' => 'Número de código', 'required')) }}
      </div>
      <input type="hidden" name="n_comp" value="{{ $reportesislr->n_comp }}">    
      <div class="col-md-4">
        {{ Form::label('total_compra', 'Cantidad Pago:') }} 
        {{ Form::text('total_compra', null, array('class' => 'form-control', 'placeholder' =>'Total Pago', 'id' => 'total', 'onkeyup' => 'calcular2()', 'required')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('objreten', 'Cantidad Objeto Retenido:') }} 
        {{ Form::text('objreten', null, array('class' => 'form-control', 'id' => 'objreten', 'onkeyup' => 'calcular2()', 'required')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('iva', 'Impuesto:') }} 
        <input type="text" name="iva" class="form-control" id="iva" onkeyup="calcular2()" readonly required value="{{ $proveedor->porcentaje }} ">
      </div>
      <div class="col-md-4">
        {{ Form::label('impuesto_iva', 'Total Impuesto:') }} 
        {{ Form::text('impuesto_iva', null, array('class' => 'form-control', 'id' => 'impuesto', 'onkeyup' => 'calcular2()', 'required')) }}
      </div>
    </div>
</div>
    <br>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      {{ Form::button('<i class="fa fa-plus-circle fa-fw"></i> ' . 'Agregar pago', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
    </div>
  {{ Form::close() }}
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
@stop