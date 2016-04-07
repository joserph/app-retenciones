<?php

class SuscripcionController extends BaseController {

	public function getIndex()
	{
		return View::make('suscripcion.index');
	}


	public function getCreate()
	{
		$action = 'Crear';
		$hoy = date('d/m/');
		$anio = date('Y');
		$proxAnio = date('Y') + 1;
		//dd($hoy);
		return View::make('suscripcion.create')
			->with('action', $action)
			->with('hoy', $hoy)
			->with('anio', $anio)
			->with('proxAnio', $proxAnio);
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(),
			array(
				'nombre'	=>	'required',
				'email' 	=>	'required|email|unique:suscripcion',
				'desde' 	=> 	'required',
				'hasta' 	=> 	'required'
			)
		);

		if($validator->fails())
		{
			return Redirect::route('suscripcion-create')->withErrors($validator)->withInput();
		}else{
			$nombre		= Input::get('nombre');
			$email 		= Input::get('email');
			$desde 		= Input::get('desde');
			$hasta 		= Input::get('hasta');

			// Activacion de code.

			$code		= str_random(60);

			$suscripcion = Suscripcion::create(array(
				'nombre'		=> $nombre,
				'email'			=> $email,
				'desde'			=> $desde,
				'hasta'			=> $hasta,
				'estatus'		=> 0,
				'code'			=> $code,
				'id_user'		=> Auth::user()->id,
				'update_user'	=> Auth::user()->id
			));

			if($suscripcion)
			{
				// Envio de email
				Mail::send('emails.suscripcion.activate', array('link' => URL::route('suscripcion-activate', $code), 'nombre' => $nombre), function($message) use ($suscripcion)
				{
					$message->to($suscripcion->email, $suscripcion->nombre)->subject('Activar suscripción');
				});

				return Redirect::route('home')
					->with('global', '<i class="fa fa-check fa-fw"></i> Su suscripción ha sido creada!, Te hemos enviado un e-mail para activar tu suscripción.');
			}
		}
	}

	public function getActivate()
	{
		$suscripcion = Suscripcion::where('code', '=', $code)->where('estatus', '=', 0);

		if($suscripcion->count())
		{
			$suscripcion = $suscripcion->first();

			// Update user to active state.

			$suscripcion->estatus = 1;
			$suscripcion->code = '';

			if($suscripcion->save())
			{
				return Redirect::route('home')
					->with('global', '<i class="fa fa-check-circle fa-fw"></i> Activado! Ahora puede disfrutar de la App por un año!');
			}
		}

		return Redirect::route('home')
				->with('global', '<i class="fa fa-exclamation-triangle fa-fw"></i> No hemos podido activar su suscripción. Inténtalo de nuevo más tarde.');
	}

}
