<?php

class AllVentasController extends \BaseController {

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
            $ventas = DB::table('reportesventas')
                ->orderBy('created_at', 'desc')
                ->where('total_v', 'LIKE', '%'.$buscar.'%')
                ->orwhere('tributado', 'LIKE', '%'.$buscar.'%')
                ->orwhere('exento', 'LIKE', '%'.$buscar.'%')
                ->orwhere('impuesto', 'LIKE', '%'.$buscar.'%')
                ->paginate(10);
        }
        else
        {
            $ventas = DB::table('reportesventas')->orderBy('created_at', 'desc')->paginate(10);
        }

		$totalVentas = DB::table('reportesventas')->count();
        $contador = 0;
        $agente = Agente::find(1);
        $fechaVentas = Venta::all();

		return View::make('all-ventas.index', array(
			'ventas' => $ventas,
			'agente' => $agente,
			'fechaVentas' => $fechaVentas,
			'totalVentas' => $totalVentas))
            ->with('contador', $contador);
		//var_dump($facturas);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
