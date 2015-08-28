@extends('master.layout')

@section('content')
	
	<p>Hello, {{ Auth:: user()->username }} - Editor.</p>
	
@stop