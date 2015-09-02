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
@stop