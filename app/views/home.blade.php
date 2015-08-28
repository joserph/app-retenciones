@extends('master.layout')

@section('content')
	@if(Auth::check() && (Auth::user()->id_rol == 2))
		<p>Hello, {{ Auth:: user()->username }} y rol {{ Auth:: user()->id_rol }} - User</p>
	@elseif(Auth::check() && (Auth::user()->id_rol == 1))
		<p>Hello, {{ Auth:: user()->username }} y rol {{ Auth:: user()->id_rol }} - Editor</p>
	@elseif(Auth::check() && (Auth::user()->id_rol == 0))
		<p>Hello, {{ Auth:: user()->username }} y rol {{ Auth:: user()->id_rol }} - Admin</p>
	@else
		<p>You are not signed in.</p>
	@endif
@stop