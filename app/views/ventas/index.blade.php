@extends('master.layout')
@section ('title') Ventas de {{ $agente->nombre }} | App-Retenciones @stop
@section('content')
   
    <legend><h2><i class="fa fa-money fa-fw"></i> Ventas de {{ $agente->nombre }}</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Ventas de {{ $agente->nombre }}</li>
    </ul>
    <div>
        @if(Auth::check())
    	   <h1>
                <a href="{{ route('ventas.create') }}" class="btn btn-success col-xs-6 col-sm-6"><i class="fa fa-plus-circle fa-fw"></i> Agregar ventas</a>
            </h1>
        @endif
    </div>
    
@stop