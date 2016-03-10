<?php

class AgenteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$agente = Agente::find(1);
        $totalAgente = DB::table('agente')->count();
		return View::make('agente.index',array(
            'agente' => $agente,
            'totalAgente' => $totalAgente
        ));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$agente = new Agente;
		return View::make('agente.form', array(
			'agente' => $agente
		));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		date_default_timezone_set('America/Caracas');
		// Creamos un nuevo objeto para nuestro
        $agente = new Agente;
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($agente->isValid($data))
        {
            // Si la data es valida se la asignamos
            $agente->fill($data);
            // Guardamos
            $agente->save();
            // Y Devolvemos una redirección a la acción show para mostrar la información
            return Redirect::route('agente.show', array($agente->id))
                    ->with('create', 'El agente de retención ' . $agente->nombre . ' ha sido creado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('agente.create')->withInput()->withErrors($agente->errors);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$agente = Agente::find($id);
        $user = User::find($id);
		if (is_null($agente))
		{
			App::abort(404);
		}

		return View::make('agente.show', array(
            'agente' => $agente))
			->with('user', $user);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$agente = Agente::find($id);
        if (is_null($id))
        {
            App::abort(404);
        }

        return View::make('agente.form')
        	->with('agente', $agente);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		date_default_timezone_set('America/Caracas');
		// Creamos un nuevo objeto 
        $agente = Agente::find($id);        
        // Si el objeto no existe entonces lanzamos un error 404 :(
        if (is_null($agente))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();        
        // Revisamos si la data es válido
        if ($agente->isValid($data))
        {
            // Si la data es valida se la asignamos 
            $agente->fill($data);
            // Guardamos 
            $agente->save();
            // Y Devolvemos una redirección a la acción show para mostrar la información
            return Redirect::route('agente.show', array($agente->id))
                    ->with('editar', 'El agente de retención <b>' . $agente->nombre . '</b> ha sido actualizado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('agente.edit', $agente->id)
            		->withInput()
            		->withErrors($agente->errors);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$agente = Agente::find($id);        
        if (is_null ($agente))
        {
            App::abort(404);
        }
        
        $agente->delete();
        
        return Redirect::route('agente.index')
            ->with('delete', 'El agente de retención <b>' . $agente->nombre . '</b> ha sido eliminado correctamente.');
        
	}


}
