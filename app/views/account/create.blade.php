@extends('master.layout')
@section ('title') Regístrate | App-Retenciones @stop
@section('content')
@include ('admin/errors', array('errors' => $errors))
	<div class="row ">
	  	<div class="col-md-6 col-md-offset-3">
	  		<legend><h3 class="form-signin-heading"><i class="fa fa-plus fa-fw"></i> Regístrate</h3></legend>
			<form action="{{ URL::route('account-create-post') }} " method="post">
				{{ Form::label('email', 'Email:') }} 
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
					<input type="email" class="form-control" placeholder="Tu email" autofocus name="email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }} >					
				</div>
				{{ Form::label('username', 'Usuario:') }} 
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
					<input type="text" name="username" class="form-control" placeholder="Nombre de usuario" { (Input::old('username')) ? 'value="' . e(Input::old('username')) . '"' : '' }} >				
				</div>
				{{ Form::label('password', 'Password:') }} 
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
					<input type="password" name="password" class="form-control" placeholder="Contraseña">		
				</div>
				{{ Form::label('password', 'Repetir password:') }} 
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
					<input type="password" name="password_again" class="form-control" placeholder="Repetir contraseña">					
				</div>
				<br>
				<button class="btn btn-success btn-block" type="submit"><i class="fa fa-plus-circle fa-fw"></i> Crear cuenta</button>	
				{{ Form::token() }}
			</form>
		</div>
	</div>
@stop