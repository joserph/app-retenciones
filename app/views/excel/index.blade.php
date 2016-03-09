@extends('master.layout')

@section ('title') Generar corte de quincena | App-Retenciones @stop

@section('content')	
        
	<legend><h3><i class="fa fa-scissors fa-fw"></i> Generar corte de quincena</h3></legend>
	
	<ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li><a href="{{ route('reportes.index') }}">Lista de Retenciones I.V.A.</a></li>
        <li class="active">Generar corte de quincena</li>
    </ul>

	{{  Form::open() }}
	 	<div class="row">
      		<div class="col-md-4"> 
				{{ Form::label('fecha_i', 'Fecha Inicio:') }}
				{{ Form::input('date', 'fecha_i', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'autofocus'=>'autofocus', 'required')) }}
			</div>
		</div>
		<div class="row">
      		<div class="col-md-4"> 
				{{ Form::label('fecha_f', 'Fecha Final:') }}
				{{ Form::input('date', 'fecha_f', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'required')) }}
			</div>
		</div>
		<br>
		{{ Form::button('<i class="fa fa-scissors fa-fw"></i> '  . ' Generar corte', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
	{{  Form::close() }}
   
@stop