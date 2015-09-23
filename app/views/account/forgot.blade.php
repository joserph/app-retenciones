@extends('master.layout')
@section ('title') Recuperar contraseña | App-Retenciones @stop
@section('content')
@include ('admin/errors', array('errors' => $errors))
	<div class="row ">
	  	<div class="col-md-6 col-md-offset-3">
	  		<legend><h3 class="form-signin-heading"><i class="fa fa-key fa-fw"></i> Recuperar contraseña</h3></legend>
			
			<form action=" {{ URL::route('account-forgot-password-post') }} " method="post">
				{{ Form::label('email', 'Email:') }}
				<div class="input-group">		
			    	<div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
					<input type="email" class="form-control" placeholder="Tu email" autofocus name="email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }} >
				</div>
				<br>
				<button class="btn btn-success btn-block" type="submit"><i class="fa fa-key fa-fw"></i> Recuperar</button>
				{{ Form::token() }}	
			</form>
		</div>	  
	</div>
@stop