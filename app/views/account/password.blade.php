@extends('master.layout')
@section ('title') Cambiar contraseña | App-Retenciones @stop
@section('content')
@include ('admin/errors', array('errors' => $errors))
	<div class="row ">
	  	<div class="col-md-6 col-md-offset-3">
	  		<legend><h3 class="form-signin-heading"><i class="fa fa-refresh fa-fw"></i> Cambiar contraseña</h3></legend>
			
			<form action="{{ URL::route('account-change-password-post') }} " method="post">
				{{ Form::label('password', 'Password actual:') }}
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-unlock fa-fw"></i></div>
					<input type="password" name="old_password" class="form-control" placeholder="Tu contraseña">					
				</div>
				{{ Form::label('password', 'Password nuevo:') }}
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
					<input type="password" name="password" class="form-control" placeholder="Tu nueva contraseña">					
				</div>

				{{ Form::label('password', 'Repetir password:') }}
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
					<input type="password" name="password_again" class="form-control" placeholder="Repetir contraseña">					
				</div>
				<br>
				<button class="btn btn-warning btn-block" type="submit"><i class="fa fa-refresh fa-fw"></i> Cambiar contraseña</button>	
				{{ Form::token() }}	
			</form>
		</div>	  
	</div>
@stop