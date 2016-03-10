@extends('master.layout')
<?php
  if($user):
    $form_data = array('route' => array('profile.update', $user->id), 'method' => 'PATCH');
    $action    = 'Editar';      
  endif;
?>
@section ('title') {{ $action }} usuario | App-Retenciones @stop
@section('content')
 
    <legend><h3><i class="fa fa-edit fa-fw"></i> {{ $action }} Usuario</h3></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li><a href="{{ route('profile.show', Auth::user()->username) }}">Perfil de {{ $user->username }} </a></li>
        <li class="active">{{ $action }} Usuario</li>
    </ul>
    @include ('admin/errors', array('errors' => $errors))

  {{ Form::model($user, $form_data, array('role' => 'form')) }}
    {{ Form::label('nombre', 'Nombre:') }} 
    <div class="row">
      <div class="col-md-4">
        {{ Form::text('nombre', null, array('class' => 'form-control')) }}
      </div>
    </div>
    {{ Form::label('username', 'Username:') }}
    <div class="row">
      <div class="col-md-4">
        {{ Form::text('username', null, array('class' => 'form-control')) }}
      </div>
    </div>
    {{ Form::label('email', 'Email:') }}
    <div class="row">
      <div class="col-md-4">
        {{ Form::text('email', null, array('class' => 'form-control')) }}
      </div>
    </div>
    {{ Form::label('ubicacion', 'Ubicacion:') }} 
    <div class="row">
      <div class="col-md-4">
        {{ Form::text('ubicacion', null, array('class' => 'form-control', 'placeholder' => 'Ej. Madrid - España')) }}
      </div>
    </div>
    {{ Form::label('sexo', 'Sexo:') }}
    <div class="row">
      <div class="col-md-2">
        {{ Form::select('sexo', array(
          '' => 'Seleccionar',
          'Mujer' => 'Mujer',
          'Hombre' => 'Hombre'
          ), null, ['class' => 'form-control'])
        }}
      </div>
    </div>
    
    <br>
    {{ Form::button('<i class="fa fa-edit fa-fw"></i> ' . $action . ' usuario', array('type' => 'submit', 'class' => 'col-xs-6 col-sm-6 btn btn-warning')) }}
   
  {{ Form::close() }} 

@stop