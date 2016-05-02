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
        $mesAnterior = date('m') - 1;
        if($mesAnterior < 10){
            $anterior = '0' . $mesAnterior . '-' . $anio;
        }else{
            $anterior = $mesAnterior . '-' . $anio;
        }
        
        $anteriorX2pr = ($anterior - 1) . '-' . $anio;
        if($anteriorX2pr < 10)
        {
            $anteriorX2 = '0' .$anteriorX2pr;
        }else{
            $anteriorX2 = $anteriorX2pr;
        }
        $actual = $mes . '-' . $anio;
        $reportesTodos = DB::table('reportes')->orderBy('n_comp', 'desc')->get();
        $proveedores = Proveedor::all();
        $totalImpuestoMes = 0;
        //dd($anteriorX2);
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
                    ->with('create', 'La venta del <b>' . date('d/m/Y', strtotime($ventas->fecha_z)) . '</b> ha sido agregada correctamente.');
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
        if (is_null($ventas))
        {
            return Redirect::route('ventas.index')
                ->with('global', '<i class="fa fa-exclamation fa-fw x3"></i> Pagina no encontrada');
        }
        $agente = Agente::find(1);
        $reportesVentas = DB::table('reportesventas')->where('id_fecha', '=', $id)->get();
        $contador = 0;
        $ventasCount = DB::table('reportesventas')->where('id_fecha', '=', $id)->count();

		return View::make('ventas.show', array(
            'ventas' => $ventas,
            'agente' => $agente,
            'reportesVentas' => $reportesVentas
        ))
            ->with('contador', $contador)
            ->with('ventasCount', $ventasCount);
        //return var_dump();
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
        if (is_null($ventas))
        {
            return Redirect::route('ventas.index')
                ->with('global', '<i class="fa fa-exclamation fa-fw x3"></i> Pagina no encontrada');
        }
		$agente = Agente::find(1);

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
                    ->with('editar', 'La venta del <b>' . date('d/m/Y', strtotime($ventas->fecha_z)) . '</b> ha sido actualizada correctamente.');
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
            ->with('delete', 'La venta del <b>' . date('d/m/Y', strtotime($ventas->fecha_z)) . '</b> ha sido eliminada correctamente.');
        
	}


}
