@extends('master.layout')

@section('content')
	
	<p>Hello, {{ Auth:: user()->username }} - Administracion.</p>
	<a href="{{ URL::route('admin-users') }}">Users</a>	
@stop