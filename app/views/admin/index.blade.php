@extends('master.layout')
@section ('title') Administración de usuarios | App-Retenciones @stop
@section('content')

	<legend><h3><i class="fa fa-users fa-fw"></i> Administración de usuarios</h3></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Administración de usuarios</li>
    </ul>
	
	<a href="{{ URL::route('admin-users') }}" class="col-xs-6 col-sm-6 btn btn-info"><i class="fa fa-users fa-fw"></i> Usuarios registrados</a>	
@stop