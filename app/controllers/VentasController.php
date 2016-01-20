<?php

class VentasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		date_default_timezone_set('America/Caracas');
        $ventas = Venta::all();
        $agente = Agente::find(1);
        $contador = 0;
        $mes = date('m');
        $anio = date('Y');
        $mesAnterior = date('m') -1;
        $anterior = $mesAnterior . '-' . $anio;
        $anteriorX2 = ($mesAnterior - 1) . '-' . $anio;
        $actual = $mes . '-' . $anio;
        $reportesTodos = DB::table('reportes')->orderBy('n_comp', 'desc')->get();
        $proveedores = Proveedor::all();
        $totalImpuestoMes = 0;
        
        return View::make('ventas.index',array(
            'ventas' => $ventas,
            'agente' => $agente,
            'reportesTodos' => $reportesTodos,
            'proveedores' => $proveedores,
            'totalImpuestoMes' => $totalImpuestoMes
        ))
        	->with('contador', $contador)
        	->with('mes', $mes)
            ->with('anio', $anio)
            ->with('mesAnterior', $mesAnterior)
            ->with('anterior', $anterior)
            ->with('actual', $actual)
            ->with('anteriorX2', $anteriorX2);
        
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$ventas = new Venta;
		$agente = Agente::find(1);

      	return View::make('ventas.form', array(
            'ventas' => $ventas,
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
		// Creamos un nuevo objeto para nuestro nuevo agente
        $ventas = new Venta;
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($ventas->isValid($data))
        {
            // Si la data es valida se la asignamos al agente
            $ventas->fill($data);
            // Guardamos el agente
            $ventas->save();
            // Y Devolvemos una redirección a la acción show para mostrar el agente
            return Redirect::route('ventas.show', array($ventas->id))
                    ->with('create', 'La venta ha sido agregada correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('ventas.create')->withInput()->withErrors($ventas->errors);
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
		$ventas = Venta::find($id);
        $agente = Agente::find(1);
        $reportesVentas = DB::table('reportesventas')->where('id_fecha', '=', $id)->get();
        $contador = 0;
        $totalVentas = DB::table('reportesventas')->count();

		if (is_null($ventas))
		{
			App::abort(404);
		}

		return View::make('ventas.show', array(
            'ventas' => $ventas,
            'agente' => $agente,
            'reportesVentas' => $reportesVentas,
            'totalVentas' => $totalVentas
            )
        )->with('contador', $contador);
        //return var_dump($totalVentas);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ventas = Venta::find($id);
		$agente = Agente::find(1);

        if (is_null($id))
        {
            App::abort(404);
        }

        return View::make('ventas.form')
        	->with('ventas', $ventas)
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
		// Creamos un nuevo objeto para nuestro nuevo usuario
        $ventas = Venta::find($id);
        
        // Si el usuario no existe entonces lanzamos un error 404 :(
        if (is_null($ventas))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($ventas->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $ventas->fill($data);
            // Guardamos el usuario
            $ventas->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('ventas.show', array($ventas->id))
                    ->with('editar', 'La venta ha sido actualizada correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('ventas.edit', $ventas->id)
            		->withInput()
            		->withErrors($ventas->errors);
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
		$ventas = Venta::find($id);
        
        if (is_null ($ventas))
        {
            App::abort(404);
        }
        
        $ventas->delete();
       
        return Redirect::route('ventas.index')
            ->with('delete', 'La venta ha sido eliminada correctamente.');
        
	}


}
