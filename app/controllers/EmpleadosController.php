<?php

class EmpleadosController extends \BaseController {

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
            $empleados = DB::table('empleados')
                ->orderBy('created_at', 'desc')
                ->where('tipo', 'LIKE', '%'.$buscar.'%')
                ->orwhere('nombre', 'LIKE', '%'.$buscar.'%')
                ->orwhere('rif', 'LIKE', '%'.$buscar.'%')
                ->orwhere('direccion', 'LIKE', '%'.$buscar.'%')
                ->orwhere('tlf', 'LIKE', '%'.$buscar.'%')
                ->paginate(10);
        }
        else
        {
            $empleados = DB::table('empleados')->orderBy('created_at', 'desc')->paginate(10);
        }

        $agente = Agente::find(1);
        $contador = 0;
        $totalEmpleados = DB::table('empleados')->count();
		return View::make('empleados.index',array(
            'empleados' => $empleados,
            'agente' => $agente,
            'totalEmpleados' => $totalEmpleados
        ))->with('contador', $contador);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$empleados = new Empleado;
      	return View::make('empleados.form', array(
            'empleados' => $empleados
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
        $empleados = new Empleado;
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($empleados->isValid($data))
        {
            // Si la data es valida se la asignamos
            $empleados->fill($data);
            // Guardamos
            $empleados->save();
            // Y Devolvemos una redirección a la acción show para mostrar
            return Redirect::route('empleados.show', array($empleados->id))
                    ->with('create', 'El empleado o proveedor ha sido creado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('empleados.create')->withInput()->withErrors($empleados->errors);
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
		$empleados = Empleado::find($id);
		if (is_null($empleados))
        {
            return Redirect::route('empleados.index')
            	->with('global', '<i class="fa fa-ban fa-fw x3"></i> Pagina no encontrada');
        }
        $user = DB::table('users')->where('id', '=', $empleados->id_user)->first();

		return View::make('empleados.show', array(
            'empleados' => $empleados,
            'user' => $user
            )
        );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$empleados = Empleado::find($id);
        if (is_null($id))
        {
            App::abort(404);
        }

        return View::make('empleados.form')
        	->with('empleados', $empleados);
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
		// Creamos un nuevo objeto para nuestro nuevo usuario
        $empleados = Empleado::find($id);
        
        // Si el usuario no existe entonces lanzamos un error 404 :(
        if (is_null($empleados))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($empleados->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $empleados->fill($data);
            // Guardamos el usuario
            $empleados->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('empleados.show', array($empleados->id))
                    ->with('editar', 'El empleado o proveedor ha sido actualizado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('empleados.edit', $empleados->id)
            		->withInput()
            		->withErrors($empleados->errors);
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
		$empleados = Empleado::find($id);
        
        if (is_null ($empleados))
        {
            App::abort(404);
        }
        
        $empleados->delete();
        
        return Redirect::route('empleados.index')
        		->with('delete', 'El empleado o proveedor ha sido eliminado correctamente.');
        
	}


}
