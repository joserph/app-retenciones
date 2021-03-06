<?php

class ReportesController extends \BaseController {

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
            $reportes = DB::table('reportes')
                ->orderBy('created_at', 'desc')
                ->where('n_comp', 'LIKE', '%'.$buscar.'%')
                ->orwhere('fecha', 'LIKE', '%'.$buscar.'%')
                ->orwhere('periodo', 'LIKE', '%'.$buscar.'%')
                ->paginate(10);
        }
        else
        {
            $reportes = DB::table('reportes')->orderBy('created_at', 'desc')->paginate(10);
        }

		$totalReportes = DB::table('reportes')->count();
		$agente = Agente::find(1);
		$proveedores = Proveedor::all();

		return View::make('reportes.index', array(
			'reportes' => $reportes,
			'totalReportes' => $totalReportes,
			'agente' => $agente,
			'proveedores' => $proveedores
		));

		//return var_dump($reportes);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        date_default_timezone_set('America/Caracas');
		$anio = date('Y');
        $mes = date('m');
        $id = 1;
        $siete = '0000000';
        $seis = '000000';
        $cinco = '00000';
        $cuatro = '0000';
        $tres = '000';
        $dos = '00';
        $uno = '0';
        /**
        * Codigo para generar el numero de comprobante automaicamente
        **/
        if ($id >= 1 && $id <= 9)
        {
            $comp = $anio."".$mes."".$siete."".$id;
            $comp2 = $siete."".$id;
        }
        else
        if ($id >= 10 && $id <= 99)
        {   
            $comp = $anio."".$mes."".$seis."".$id;
            $comp2 = $seis."".$id;
        }
        else
        if ($id >= 100 && $id <= 999)
        {
            $comp = $anio."".$mes."".$cinco."".$id;
            $comp2 = $cinco."".$id;
        }
        else
        if ($id >= 1000 && $id <= 9999)
        {
            $comp = $anio."".$mes."".$cuatro."".$id;
            $comp2 = $cuatro."".$id;
        }
        else
        if ($id >= 10000 && $id <= 99999)
        {
            $comp = $anio."".$mes."".$tres."".$id;
            $comp2 = $tres."".$id;
        }
        else
        if ($id >= 100000 && $id <= 999999)
        {
            $comp = $anio."".$mes."".$dos."".$id;
            $comp2 = $dos."".$id;
        }
        else
        if ($id >= 1000000 && $id <= 9999999)
        {
            $comp = $anio."".$mes."".$uno."".$id;
            $comp2 = $uno."".$id;
        }
        else
        if ($id >= 10000000 && $id <= 99999999)
        {
            $comp = $anio."".$mes."".$id;
            $comp2 = $id;
        }
        else
        {
            $comp = "El numero de comprobante es muy grade";
        }
        $secuencia = DB::table('agente')->max('comp');
        $max = DB::table('reportes')->max('secuencia');
        if($max >= $secuencia){
            $ultimo = $anio."".$mes."".$max + 1;
        }
        else{
            $ultimo = $anio."".$mes."".$secuencia;
        }
       
		$reportes = new Reporte;
		$agente = Agente::find(1);
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $iva = DB::table('impuesto')->where('estatus', '=', 'actual')->first();

		return View::make('reportes.form', array(
			'reportes' => $reportes,
            'agente' => $agente,
            'comp' => $comp,
            'comp2' => $comp2,
            'ultimo' => $ultimo,
            'iva' => $iva
		))
            ->with('proveedores', $proveedores);
		//return var_dump($reportes);
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
        $reportes = new Reporte;
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($reportes->isValid($data))
        {
            // Si la data es valida se la asignamos
            $reportes->fill($data);
            $reportes->secuencia = substr(Input::get('n_comp'), 6);
            // Guardamos
            $reportes->save();
            // Y Devolvemos una redirección a la acción show para mostrar la información
            return Redirect::route('reportes.show', array($reportes->id))
                    ->with('create', 'El reporte <b>' . $reportes->n_comp . '</b> ha sido creado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('reportes.create')->withInput()->withErrors($reportes->errors);
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
		$reportes = Reporte::find($id);
        if (is_null($reportes))
        {
            return Redirect::route('reportes.index')
                ->with('global', '<i class="fa fa-exclamation fa-fw x3"></i> Pagina no encontrada');
        }
        $users = User::all();
        $agente = Agente::find(1);
        $proveedor = DB::table('proveedores')->where('id', '=', $reportes->id_proveedor)->first();
        $totalFacturas = DB::table('facturas')->count();
        $facturas = new Factura;
        $todasFacturas = DB::table('facturas')->where('id_reporte', '=', $id)->get();
        $facturasCount = DB::table('facturas')->where('id_reporte', '=', $id)->count();
        $contador = 0;
        $iva = DB::table('impuesto')->where('estatus', '=', 'actual')->first();
        if(is_null($iva))
        {
            $actual = 0;
        }else{
            $actual = $iva->iva;
        }

		

		return View::make('reportes.show', array(
            'reportes' => $reportes,
            'users' => $users,
            'agente' => $agente,
            'proveedor' => $proveedor,
            'facturas' => $facturas,
            'todasFacturas' => $todasFacturas,
            'contador' => $contador,
            'iva' => $iva
            ))
			->with('totalFacturas', $totalFacturas)
            ->with('facturasCount', $facturasCount);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$reportes = Reporte::find($id);
        if (is_null($reportes))
        {
            return Redirect::route('reportes.index')
                ->with('global', '<i class="fa fa-exclamation fa-fw x3"></i> Pagina no encontrada');
        }
        $agente = Agente::find(1);
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->lists('nombre', 'id');

        return View::make('reportes.edit', array(
            'agente' => $agente
            ))
            ->with('proveedores', $proveedores)
            ->with('reportes', $reportes);
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
        $reportes = Reporte::find($id);        
        // Si el objeto no existe entonces lanzamos un error 404 :(
        if (is_null($reportes))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();        
        // Revisamos si la data es válido
        if ($reportes->isValid($data))
        {
            // Si la data es valida se la asignamos 
            $reportes->fill($data);
            // Guardamos 
            $reportes->save();
            // Y Devolvemos una redirección a la acción show para mostrar la información
            return Redirect::route('reportes.show', array($reportes->id))
                    ->with('editar', 'El reporte <b>' . $reportes->n_comp . '</b> ha sido actualizado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('reportes.edit', $reportes->id)
            	->withInput()
            	->withErrors($reportes->errors);
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
		$reportes = Reporte::find($id);
        
        if (is_null ($reportes))
        {
            App::abort(404);
        }        
        $reportes->delete();
        
        return Redirect::route('reportes.index')
            ->with('delete', 'El reporte <b>' . $reportes->n_comp . '</b> ha sido eliminado correctamente.');
	}


}
