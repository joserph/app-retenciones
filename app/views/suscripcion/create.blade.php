@extends('master.layout')

@section ('title') {{ $action }} suscripción | App-Retenciones @stop
@section('content')
	
	<legend><h3><i class="fa fa-plus-circle fa-fw"></i> {{ $action }} suscripción</h3></legend>
	<ul class="breadcrumb">
    	<li><a href="{{ URL::route('home') }}">Inicio</a></li>
    	<li><a href="{{ URL::route('suscripcion') }}">Impuesto I.V.A.</a></li>
    	<li class="active">{{ $action }} suscripción</li>
  	</ul> 
	@include ('admin/errors', array('errors' => $errors))
	<form action="{{ URL::route('suscripcion-create-post') }}" method="post">
  		{{ Form::label('nombre', 'Nombre') }}
		<div class="row">
      		<div class="col-xs-8">
      			{{ Form::text('nombre', null, array('class' => 'form-control', 'placeholder' => 'Nombre de la empresa')) }}
      		</div>
      	</div>
		{{ Form::label('email', 'Correo') }}
		<div class="row">
      		<div class="col-xs-6">
      			{{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Correo de la empresa', 'required')) }}
      		</div>
      	</div>
      	{{  Form::label('desde', 'Desde') }}
      	<div class="row">
      		<div class="col-xs-6">
      			{{ Form::input('date', 'desde', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'required')) }}
      		</div>
      	</div>
      	{{  Form::label('hasta', 'Hasta') }}
      	<div class="row">
      		<div class="col-xs-6">
      			{{ Form::input('date', 'hasta', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'required')) }}
      		</div>
      	</div>
      	<br>
      	  
      	{{ Form::button('<i class="fa fa-plus-circle fa-fw"></i> ' . $action.' suscripción', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
      	{{ Form::token() }}
	</form>   
@stop