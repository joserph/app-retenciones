@extends('master.layout')

@section ('title') Lista de reportes excels | App-Retenciones @stop

@section('content')	
        
	<h2>Elige rango de fecha</h2>

	{{  Form::open() }}
		{{ Form::label('fecha_i', 'Fecha Inicio:') }}
		{{ Form::input('date', 'fecha_i', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'autofocus'=>'autofocus')) }}

		{{ Form::label('fecha_f', 'Fecha Final:') }}
		{{ Form::input('date', 'fecha_f', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'autofocus'=>'autofocus')) }}
		<br>
		{{ Form::button('<i class="fa fa-plus-circle fa-fw"></i> '  . ' Buscar', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-success')) }}
	{{  Form::close() }}
   
@stop