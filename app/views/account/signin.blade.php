@extends('master.layout')
@section ('title') Iniciar sesión | App-Retenciones @stop
@section('content')
@include ('admin/errors', array('errors' => $errors))
	<div class="row ">
	  	<div class="col-md-6 col-md-offset-3">
	  		<legend><h3 class="form-signin-heading">Iniciar sesión</h3></legend>
			
			<form action="{{ URL::route('account-sign-in-post') }} " method="post">		
			{{ Form::label('email', 'Email:') }}
			<div class="input-group">		
			    <div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
			    <input type="email" class="form-control" placeholder="Tu email" autofocus name="email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }}>
			</div>
			{{ Form::label('password', 'Password:') }}
			<div class="input-group">		
			    <div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
			    <input type="password" name="password" class="form-control" placeholder="Tu contraseña">
			</div>
			<div class="checkbox">
				<label for="remember">
					<input type="checkbox" name="remember" id="remember"> Recuérdame 
				</label>
			</div>
			<button class="btn btn-info btn-block" type="submit"><i class="fa fa-sign-in fa-fw"></i> Iniciar sesión</button>
			{{ Form::token() }}
			</form>
	  	</div>	  
	</div>
@stop