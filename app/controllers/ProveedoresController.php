<?php

class ProveedoresController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(isset($_GET['buscar']))
        {
            $buscar = Input::get('buscar');
            $proveedores = DB::table('proveedores')
                ->orderBy('created_at', 'desc')
                ->where('nombre', 'LIKE', '%'.$buscar.'%')
                ->orwhere('rif', 'LIKE', '%'.$buscar.'%')
                ->orwhere('direccion', 'LIKE', '%'.$buscar.'%')
                ->paginate(10);
        }
        else
        {
            $proveedores = DB::table('proveedores')->orderBy('created_at', 'desc')->paginate(10);
        }   

		$totalProveedores = DB::table('proveedores')->count();
		$contador = 0;
		if($totalProveedores == 0)
		{
			$proveedores = 'nulo';
		}

		return View::make('proveedores.index', array(
			'proveedores' => $proveedores,
			'totalProveedores' => $totalProveedores))
			->with('contador', $contador);
		//return var_dump($proveedores);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$proveedores = new Proveedor;

		return View::make('proveedores.form', array(
			'proveedores' => $proveedores
		));
		//return var_dump($proveedores);
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
        $proveedores = new Proveedor;
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($proveedores->isValid($data))
        {
            // Si la data es valida se la asignamos
            $proveedores->fill($data);
            // Guardamos
            $proveedores->save();
            // Y Devolvemos una redirección a la acción show para mostrar la información
            return Redirect::route('proveedores.show', array($proveedores->id))
                    ->with('create', 'El proveedor <b>' . $proveedores->nombre . '</b> ha sido agregado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('proveedores.create')->withInput()->withErrors($proveedores->errors);
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
		$proveedores = Proveedor::find($id);
		if (is_null($proveedores))
        {
            return Redirect::route('proveedores.index')
            	->with('global', '<i class="fa fa-exclamation fa-fw x3"></i> Pagina no encontrada');
        }
		$user = DB::table('users')->where('id', '=', $proveedores->id_user)->first();

		return View::make('proveedores.show', array(
			'proveedores' => $proveedores,
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
		$proveedores = Proveedor::find($id);
        if (is_null($proveedores))
        {
            return Redirect::route('proveedores.index')
            	->with('global', '<i class="fa fa-exclamation fa-fw x3"></i> Pagina no encontrada');
        }

        return View::make('proveedores.form')
        	->with('proveedores', $proveedores);
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
        $proveedores = Proveedor::find($id);        
        // Si el objeto no existe entonces lanzamos un error 404 :(
        if (is_null($proveedores))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();        
        // Revisamos si la data es válido
        if ($proveedores->isValid($data))
        {
            // Si la data es valida se la asignamos 
            $proveedores->fill($data);
            // Guardamos 
            $proveedores->save();
            // Y Devolvemos una redirección a la acción show para mostrar la información
            return Redirect::route('proveedores.show', array($proveedores->id))
                    ->with('editar', 'El proveedor <b>' . $proveedores->nombre . '</b> ha sido actualizado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('proveedores.edit', $proveedores->id)
            		->withInput()
            		->withErrors($proveedores->errors);
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
		$proveedores = Proveedor::find($id);
        
        if (is_null ($proveedores))
        {
            App::abort(404);
        }        
        $proveedores->delete();
        
        return Redirect::route('proveedores.index')
            ->with('delete', 'El proveedor <b>' . $proveedores->nombre . '</b> ha sido eliminado correctamente.');
	}


}
