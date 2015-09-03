<?php

class IvaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$totalIva = DB::table('impuesto')->count();
		$iva = DB::table('impuesto')->where('estatus', '=', 'actual')->first();
		$historialIva = Iva::all();
		if(is_null($iva))
		{
			$iva = 'vencido';
		}
		return View::make('iva.index', array(
			'totalIva' => $totalIva,
			'iva' => $iva,
			'historialIva' => $historialIva
		));
		//return var_dump($iva);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$iva = new Iva;
        
      	return View::make('iva.form', array(
            'iva' => $iva
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
		// Creamos un nuevo objeto
        $iva = new Iva;
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($iva->isValid($data))
        {
            // Si la data es valida se la asignamos
            $iva->fill($data);
            // Guardamos
            $iva->save();
            // Y Devolvemos una redirección a la acción show para mostrar la información
            return Redirect::route('iva.show', array($iva->id))
                    ->with('create', 'El I.V.A. ha sido agregado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('iva.create')->withInput()->withErrors($iva->errors);
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
		$iva = Iva::find($id);
		if (is_null($iva))
        {
            return Redirect::route('iva.index')
            	->with('global', '<i class="fa fa-ban fa-fw x3"></i> Pagina no encontrada');
        }
		$user = DB::table('users')->where('id', '=', $iva->id_user)->first();
		return View::make('iva.show', array(
			'iva' => $iva,
			'user' => $user));
		//return var_dump($user);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$iva = Iva::find($id);
        if (is_null($id))
        {
            App::abort(404);
        }

        return View::make('iva.form')
        	->with('iva', $iva);
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
        $iva = iva::find($id);        
        // Si el objeto no existe entonces lanzamos un error 404 :(
        if (is_null($iva))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();        
        // Revisamos si la data es válido
        if ($iva->isValid($data))
        {
            // Si la data es valida se la asignamos 
            $iva->fill($data);
            // Guardamos 
            $iva->save();
            // Y Devolvemos una redirección a la acción show para mostrar la información
            return Redirect::route('iva.show', array($iva->id))
                    ->with('editar', 'El I.V.A. ha sido actualizado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('iva.edit', $iva->id)
            		->withInput()
            		->withErrors($iva->errors);
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
		$iva = Iva::find($id);
        
        if (is_null ($iva))
        {
            App::abort(404);
        }
        
        $iva->delete();

        
        return Redirect::route('iva.index')
            ->with('delete', 'El I.V.A. ha sido eliminado correctamente.');
       
	}


}
