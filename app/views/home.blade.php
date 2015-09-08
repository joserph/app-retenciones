@extends('master.layout')
@if($totalAgente == 0)
    @section ('title') App-Retenciones @stop
@else
    @section ('title') {{ $agente->nombre }} | App-Retenciones @stop
@endif
@section('content')
	<legend>
		<h1 class="text-center">Sistema de Retenciones IVA - ISLR</h1>
		@if($totalAgente == 0)
			
		@else
			<h2 class="text-center">{{ $agente->nombre }}</h2>
		@endif		
	</legend>
	@if($iva != 'vencido')
	<div class="row">
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
	</div>
	@elseif(Auth::check())
		<h1><a href="{{ route('iva.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="right" title="Agregar I.V.A."><i class="fa fa-plus fa-fw"></i> Agregar I.V.A.</a></h1>
	@endif	
@stop