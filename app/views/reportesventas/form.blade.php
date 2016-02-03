<div>
  <div class="load_ajax"></div>
  <div class="bg-danger"><h3 class="errors_form"></h3></div>  
</div>  
<div class="form">
  {{ Form::open(array('url' => 'reportes-ventas-create', 'class' => 'create_reporte_venta')) }} 
              
    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
    <input type="hidden" name="update_user" value="{{ Auth:: user()->id }}">
    <input type="hidden" name="id_fecha" value="{{ $ventas->id }}">
           
    <div class="row">
      <div class="col-md-4">
        {{ Form::label('n_zetas', 'Número de reporte:') }} 
        {{ Form::text('n_zetas', null, array('class' => 'form-control', 'placeholder' =>'Nº reporte zeta', 'autofocus', 'required')) }}
      </div>   
      <div class="col-md-4">
        {{ Form::label('total_v', 'Total:') }} 
        {{ Form::text('total_v', null, array('class' => 'form-control', 'placeholder' =>'Total ventas', 'id' => 'total_v1', 'onkeyup' => 'calcular(1)', 'required')) }}
      </div>      
      <div class="col-md-4">
        {{ Form::label('tributado', 'Tributado:') }} 
        {{ Form::text('tributado', null, array('class' => 'form-control', 'placeholder' =>'Monto tributados', 'required', 'id' => 'tributado1', 'onkeyup' => 'calcular(1)')) }}
      </div>   
      <div class="col-md-4">
        {{ Form::label('exento', 'Exento:') }} 
        {{ Form::text('exento', null, array('class' => 'form-control', 'placeholder' =>'Monto exentos', 'id' => 'exento1', 'onkeyup' => 'calcular(1)', 'required')) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('impuesto', 'Impuesto:') }} 
        {{ Form::text('impuesto', null, array('class' => 'form-control', 'placeholder' =>'Monto impuesto', 'id' => 'impuesto1', 'onkeyup' => 'calcular(1)')) }}
      </div>      
    </div>    
    <br>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      {{ Form::button('<i class="fa fa-plus-circle fa-fw"></i> ' . 'Agregar reporte', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
    </div>
    
  {{ Form::close() }}
</div>

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