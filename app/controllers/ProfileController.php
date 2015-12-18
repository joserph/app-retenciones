<?php

class ProfileController extends \BaseController 
{
	public function index()
	{
		
	}

	public function create()
	{
		
	}

	public function store()
	{
		
	}

	public function show($username)
	{
        $user = User::where('username', '=', $username);

		if(Auth::user()->username == $username)
		{
			$user = $user->first();

			return View::make('profile.index')
				->with('user', $user);
		}

		return Redirect::route('home')
			->with('global', 'No es tu Perfil.');
	}


	public function edit($id)
	{
        $user = User::find($id);

        if(Auth::user()->id == $id)
        {
            return View::make('profile.form', array('user' => $user));
        }

        return Redirect::route('home')
            ->with('global', 'No es tu Perfil.');
	}


	public function update($id)
	{
		// Creamos un nuevo objeto para nuestro nuevo usuario
        $user = User::find($id);
        
        // Si el usuario no existe entonces lanzamos un error 404 :(
        if (is_null ($user))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($user->isValid2($data))
        {
            // Si la data es valida se la asignamos al usuario
            $user->fill($data);
            // Guardamos el usuario
            $user->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('profile.show', array($user->username))
                    ->with('editar', 'Tu perfil ha sido actualizado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('profile.edit', $user->id)
            		->withInput()
            		->withErrors($user->errors);
        }
	}


	public function destroy($id)
	{
		
	}


}
