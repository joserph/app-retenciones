<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest(URL::route('account-sign-in'));
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
| Admin filter.
*/
Route::filter('admon', function()
{
	if(Auth::user()->id_rol != 0)
	{
		return Redirect::route('home')
			->with('global', '<i class="fa fa-exclamation fa-fw x3"></i> No posee privilegios para acceder a esta pagina');
	}		
});
/*
| Editor filter.
*/
Route::filter('editor', function()
{
	if((Auth::user()->id_rol != 0) && (Auth::user()->id_rol != 1))
	{
		return Redirect::route('home')
			->with('global', '<i class="fa fa-exclamation fa-fw x3"></i> No posee privilegios para acceder a esta pagina');
	}
});

Route::filter('suscription', function()
{
	$agente = Agente::find(1);
	if(Suscripcion::count() == 0)
	{
		return Redirect::route('home')
			->with('global', '<i class="fa fa-exclamation fa-fw"></i> Debe poseer una suscripción para disfrutar de la aplicación, Por favor ponte en contacto con <b>joserph.a@gmail.com</b>');
	}elseif($agente->estatus != 1)
	{
		return Redirect::route('home')
			->with('global', '<i class="fa fa-exclamation fa-fw"></i> La suscripción no está activa, Por favor ponte en contacto con <b>joserph.a@gmail.com<b>');
	}else{
		
		$dia = date('d', strtotime($agente->hasta));
		$mes = date('m', strtotime($agente->hasta));
		$anio = date('Y', strtotime($agente->hasta));

		$hoy = date('d-m-Y');
		if($hoy == $dia . '-' . $mes . '-' . $anio)
		{
			return Redirect::route('home')
				->with('global', '<i class="fa fa-exclamation fa-fw"></i> Hasta hoy ' . date('d/m/Y', strtotime($hoy)) . ' puedes usar la aplicación, Por favor ponte en contacto con <b>joserph.a@gmail.com<b>');
		}elseif((date('d', strtotime($hoy)) > $dia) && (date('m', strtotime($hoy)) == $mes) && (date('Y', strtotime($hoy)) == $anio))
		{
			return Redirect::route('home')
				->with('global', '<i class="fa fa-exclamation fa-fw"></i> Su suscripción vencio el dia ' . date('d/m/Y', strtotime($agente->hasta)) . ' y por esa razón no puedes usar la aplicación, Por favor ponte en contacto con <b>joserph.a@gmail.com<b>');
		}elseif((date('m', strtotime($hoy)) > $mes) && (date('Y', strtotime($hoy)) == $anio))
		{
			return Redirect::route('home')
				->with('global', '<i class="fa fa-exclamation fa-fw"></i> Su suscripción vencio el dia ' . date('d/m/Y', strtotime($agente->hasta)) . ' y por esa razón no puedes usar la aplicación, Por favor ponte en contacto con <b>joserph.a@gmail.com<b>');
		}elseif(date('Y', strtotime($hoy)) > $anio)
		{
			return Redirect::route('home')
				->with('global', '<i class="fa fa-exclamation fa-fw"></i> Su suscripción vencio el dia ' . date('d/m/Y', strtotime($agente->hasta)) . ' y por esa razón no puedes usar la aplicación, Por favor ponte en contacto con <b>joserph.a@gmail.com<b>');
		}
	}
});