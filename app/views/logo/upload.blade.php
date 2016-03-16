@extends ('master.layout')
@section ('title') Cambiar logo | App-Retenciones @stop
@section ('content')
	<legend><h3><i class="fa fa-photo fa-fw"></i> Cambiar logo</h3></legend>

    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Cambiar logo</li>
    </ul>

    {{ Form::open(array('url' => 'logo', 'files' => true)) }}
		{{ Form::label('file', 'Logo') }}
		{{ Form::file('file') }}
		<br>
		{{ Form::submit('Subir', array('class' => 'btn btn-success')) }}
    {{ Form::close() }}
@stop