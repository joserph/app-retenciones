@extends('master.layout')
@if($totalAgente == 0)
    @section ('title') App-Retenciones @stop
@else
    @section ('title') {{ $agente->nombre }} | App-Retenciones @stop
@endif
@section('content')
	<legend>
		<h1 class="text-center">Sistema de Retenciones I.V.A. - I.S.L.R.</h1>
		@if($totalAgente == 0)
			
		@else
			<h2 class="text-center"><i class="fa fa-building fa-fw"></i> {{ $agente->nombre }}</h2>
		@endif		
	</legend>
	@if($iva != 'vencido')
	<div class="row">
        <!--I.V.A. actual-->
		<div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $iva->iva }}%</div>
                            <div>I.V.A. Actual!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('iva.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left"><i class="fa fa-eye fa-fw"></i> Ver Detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!--Fin I.V.A. actual-->
        <!--Retenciones I.V.A. de hoy-->
        <div class="col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-pdf-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">Retenciones I.V.A.</div>
                            <div>Hoy {{ date('d/m/Y', strtotime($hoy)) }}!</div>
                        </div>
                    </div>
                </div>                
                <div class="panel-footer">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-responsive">
                            <tr class="warning">
                                <th>#</th>
                                <th>Comprobante</th>
                                <th>Proveedor</th> 
                                <th>Monto</th>                           
                            </tr>
                            @foreach($reportesIva as $item)
                                <tr>
                                    <td>{{ $contador += 1 }}</td>
                                    <td>{{ $item->n_comp }}</td>
                                    @foreach($proveedores as $proveedor)
                                        @if(($proveedor->id) == ($item->id_proveedor))
                                            <td>{{ $proveedor->nombre }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ number_format($totalFacturas,2,",",".") }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>                
            </div>
        </div>
        <!--Fin Retenciones I.V.A. de hoy-->
	</div>
	@elseif(Auth::check())
		<h1><a href="{{ route('iva.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="right" title="Agregar I.V.A."><i class="fa fa-plus fa-fw"></i> Agregar I.V.A.</a></h1>
	@endif	
@stop