@extends('master.layout')
@if($totalAgente == 0)
    @section ('title') App-Retenciones @stop
@else
    @section ('title') {{ $agente->nombre }} | App-Retenciones @stop
@endif
@section('content')
	

    <legend><h3><i class="fa fa-building fa-fw"></i> Agente de Retención</h3></legend>
    
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Agente de Retención</li>
    </ul> 

    @if((Auth::check()) && ($totalAgente < 1))
       <h1><a href="{{ route('agente.create') }}" class="col-xs-6 col-sm-6 btn btn-success" data-toggle="tooltip" data-placement="right" title="Agregar agente de retención"><i class="fa fa-plus-circle fa-fw"></i> Agregar agente</a></h1>
    @endif
    @if(Auth::check())
    <div class="text-center ">
        {{ HTML::image('assets/img/logo.jpg', 'logo', array('class' => 'img-responsive img-rounded profile', 'width' => '100')) }}
        <a href="{{ route('logo') }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> <small>Editar logo</small></a>
    </div>
    @endif
    <hr>

    @if($totalAgente >= 1)
        <div class="row text-center">
            <h2>{{ $agente->nombre }}</h2>
            <h4>{{ $agente->rif }}</h4>
            <h4><span class="glyphicon glyphicon-phone-alt"></span> {{ $agente->tlf }}</h4>
            <h4>Secuencia IVA: {{ $agente->comp }}</h4> 
            <h4>Secuencia ISLR: {{ $agente->compislr }}</h4>
            <h4><span class="glyphicon glyphicon-map-marker"></span> {{ $agente->direccion }}</h4>
            @if (Auth::check() && Auth::user()->id_rol != 2)
                <a href="{{ route('agente.edit', $agente->id) }}" class="btn btn-warning col-md-6 col-md-offset-3"><i class="fa fa-edit fa-fw"></i> Editar</a>
            @endif            
        </div>
    @elseif(Auth::check() && $totalAgente < 1)
    	<div class="alert alert-dismissible alert-warning">
		  	<button type="button" class="close" data-dismiss="alert">×</button>
		  	<h4>Atención!</h4>
		  	<p>No has agregado el agente de retención, para hacerlo has click en, <a href="{{ route('agente.create') }}" class="alert-link">Agragar agente</a>.</p>
		</div>
    @endif   
@stop