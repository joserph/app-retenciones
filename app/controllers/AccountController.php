<?php

class AccountController extends BaseController {

	public function getSignIn()
	{
		return View::make('account.signin');
	}

	public function postSignIn()
	{
		$validator = Validator::make(Input::all(),
			array(
				'email' 	=> 'required|email',
				'password' 	=> 'required'
			)
		);

		if($validator->fails())
		{
			return Redirect::route('account-sign-in')
					->withErrors($validator)
					->withInput();
		}
		else
		{
			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'active' => 1
			), $remember);

			if($auth)
			{
				// Redirecciona a la pagina intended.
				return Redirect::intended('/');
			}
			else
			{
				return Redirect::route('account-sign-in')
				->with('global', '<i class="fa fa-exclamation-triangle fa-fw"></i> Email/Contraseña incorrectos, o cuenta no activada.');
			}
		}

		return Redirect::route('account-sign-in')
				->with('global', '<i class="fa fa-exclamation-triangle fa-fw"></i> Hubo un problema al momento de registrarse.');
	}

	public function getSignOut()
	{
		Auth::logout();
		return Redirect::route('home');
	}

	public function getCreate()
	{
		return View::make('account.create');	
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(),
			array(
				'email' 			=>	'required|max:50|email|unique:users',
				'username' 			=> 	'required|max:20|min:5|unique:users',
				'password' 			=> 	'required|min:6',
				'password_again' 	=> 	'required|same:password'
			)
		);

		if($validator->fails())
		{
			return Redirect::route('account-create')
					->withErrors($validator)
					->withInput();
		}
		else
		{
			$email 		= Input::get('email');
			$username 	= Input::get('username');
			$password 	= Input::get('password');

			// Activacion de code.

			$code		= str_random(60);

			$user = User::create(array(
				'email'		=> $email,
				'username'	=> $username,
				'password'	=> Hash::make($password),
				'code' 		=> $code,
				'active'	=> 0,
				'id_rol'	=> 2
			));
			
			if($user)
			{
				// Envio de email
				Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username ), function($message) use ($user)
					{
						$message->to($user->email, $user->username)->subject('Activar su cuenta');
					});

				return Redirect::route('home')
					->with('global', '<i class="fa fa-check fa-fw"></i> Su cuenta ha sido creada!, Te hemos enviado un e-mail para activar tu cuenta.');
			}
		}
	}

	public function getActivate($code)
	{
		$user = User::where('code', '=', $code)->where('active', '=', 0);

		if($user->count())
		{
			$user = $user->first();

			// Update user to active state.

			$user->active 	= 1;
			$user->code 	= '';
			$user->id_rol 	= 1;

			if($user->save())
			{
				return Redirect::route('home')
						->with('global', '<i class="fa fa-check-circle fa-fw"></i> Activado! Ahora puede iniciar sesión!');
			}
		}

		return Redirect::route('home')
				->with('global', '<i class="fa fa-exclamation-triangle fa-fw"></i> No hemos podido activar su cuenta. Inténtalo de nuevo más tarde.');
	}

	public function getChangePassword()
	{
		return View::make('account.password');
	}

	public function postChangePassword()
	{

		$validator = Validator::make(Input::all(),
			array(
				'old_password' => 'required',
				'password' => 'required|min:6',
				'password_again' => 'required|same:password'
			)
		);

		if($validator->fails())
		{
			return Redirect::route('account-change-password')
					->withErrors($validator);
		}
		else
		{
			$user 			= User::find(Auth::user()->id);

			$old_password 	= Input::get('old_password');
			$password 		= Input::get('password');

			if(Hash::check($old_password, $user->getAuthPassword()))
			{
				$user->password = Hash::make($password);

				if($user->save())
				{
					return Redirect::route('profile.show', array(Auth::user()->username))
							->with('global', '<i class="fa fa-check fa-fw"></i> Su contraseña ha sido cambiada.');
				}
				else
				{
					return Redirect::route('account-change-password')
							->with('global', '<i class="fa fa-exclamation-triangle fa-fw"></i> Su contraseña es incorrecta.');
				}
			}
		}

		return Redirect::route('account-change-password')
				->with('global', '<i class="fa fa-exclamation-triangle fa-fw"></i> Su contraseña no se pudo cambiar. Inténtalo de nuevo más tarde.');
	}	

	public function getForgotPassword()
	{
		return View::make('account.forgot');
	}

	public function postForgotPassword()
	{
		$validator = Validator::make(Input::all(), 
			array(
				'email' => 'required|email'		
			)
		);

		if($validator->fails())
		{
			return Redirect::route('account-forgot-password')
					->withErrors($validator)
					->withInput();
		}
		else
		{
			$user = User::where('email', '=', Input::get('email'));

			if($user->count())
			{
				$user = $user->first();

				// Generamos un nuevo codigo y password.

				$code = str_random(60);
				$password = str_random(10);

				$user->code = $code;
				$user->password_temp = Hash::make($password);

				if($user->save())
				{
					Mail::send('emails.auth.forgot', array('link' => URL::route('account-recover', $code), 'username' => $user->username, 'password' => $password ), function($message) use ($user)
						{
							$message->to($user->email, $user->username)->subject('Nueva contraseña');
						});

					return Redirect::route('home')
							->with('global', '<i class="fa fa-check fa-fw"></i> Te hemos enviado una nueva contraseña a tu e-mail.');
				}
			}
		}

		return Redirect::route('account-forgot-password')
				->with('global', '<i class="fa fa-exclamation-triangle fa-fw"></i> No hemos podido recuperar su contraseña. Inténtalo de nuevo más tarde.');
	}

	public function getRecover($code)
	{
		$user = User::where('code', '=', $code)
				->where('password_temp', '!=', '');

		if($user->count())
		{
			$user = $user->first();

			$user->password 		= $user->password_temp;
			$user->password_temp 	= '';
			$user->code 			= '';

			if($user->save())
			{
				return Redirect::route('home')
						->with('global', '<i class="fa fa-check-circle fa-fw"></i> Su cuenta ha sido recuperada y puede acceder con su nueva contraseña.');
			}
		}

		return Redirect::route('home')
				->with('global', '<i class="fa fa-exclamation-triangle fa-fw"></i> No se ha podido recuperar su cuenta. Inténtalo de nuevo más tarde.');
	}

}
