<?php

class ReportesislrController extends \BaseController {

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
            $reportesislr = DB::table('reportesislr')
                ->orderBy('created_at', 'desc')
                ->where('n_comp', 'LIKE', '%'.$buscar.'%')
                ->orwhere('fecha', 'LIKE', '%'.$buscar.'%')
                ->orwhere('periodo', 'LIKE', '%'.$buscar.'%')
                ->paginate(10);
        }
        else
        {
            $reportesislr = DB::table('reportesislr')->orderBy('created_at', 'desc')->paginate(10);
        }
      
        $agente = Agente::find(1);
        $contador = 0;
        $empleados = DB::table('empleados')->get();
        $totalReportesislr = DB::table('reportesislr')->count();
        
		return View::make('reportesislr.index',array(
            'reportesislr' => $reportesislr,
            'empleados' => $empleados,
            'agente' => $agente,
            'totalReportesislr' => $totalReportesislr
        ))->with('contador', $contador);
		//return var_dump($empleados);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
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
        $secuencia = DB::table('agente')->max('compislr');
        $max = DB::table('reportesislr')->max('secuencia');
        if($max >= $secuencia){
            $ultimo = $max + 1;
        }
        else{
            $ultimo = $secuencia;
        }

		$reportesislr = new Reporteislr;
        $agente = Agente::find(1);
        $proveedor = DB::table('empleados')->where('id', '=', $reportesislr->id_empleado)->first();
        $empleados = Empleado::all();
      	return View::make('reportesislr.form', array(
            'reportesislr' => $reportesislr,
            'agente' => $agente,
            'proveedor' => $proveedor,
            'empleados' => $empleados,
            'comp' => $comp,
            'comp2' => $comp2,
            'ultimo' => $ultimo
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
        $reportesislr = new Reporteislr;
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($reportesislr->isValid($data))
        {
            // Si la data es valida se la asignamos
            $reportesislr->fill($data);
            // Guardamos 
            $reportesislr->save();
            // Y Devolvemos una redirección a la acción show para mostrar la informacion
            return Redirect::route('islr-reportes.show', array($reportesislr->id))
                    ->with('create', 'El reporte de I.S.L.R. Nº <b>' . $reportesislr->n_comp . '</b> ha sido creado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('islr-reportes.create', array($reportesislr->id))
                ->withInput()->withErrors($reportesislr->errors);
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
		$reportesislr = Reporteislr::find($id);
        if (is_null($reportesislr))
        {
            return Redirect::route('islr-reportes.index')
                ->with('global', '<i class="fa fa-exclamation fa-fw x3"></i> Pagina no encontrada');
        }
        $users = User::all();
        $agente = Agente::find(1);
        $proveedor = DB::table('empleados')->where('id', '=', $reportesislr->id_empleado)->first();
        $empleados = Empleado::all();
        $totalPagosEmpleado = DB::table('facturasislr')->where('tipo', '=', 'empleado')->count();
        $totalFacturasProveedor = DB::table('facturasislr')->where('tipo', '=', 'proveedor')->count();
        $facturasCount = db::table('facturasislr')->where('id_reporteislr', '=', $id)->count();
        //$facturasislr = new Facturaislr;
        $items = DB::table('facturasislr')->where('id_reporteislr', '=', $id)->get();
        //$facts = DB::table('facturasislr')->where('id_reporteislr', '=', $id)->get();
        $contador = 0;
		

		return View::make('reportesislr.show', array(
            'reportesislr' => $reportesislr,
            'users' => $users,
            'agente' => $agente,
            'proveedor' => $proveedor,
            'empleados' => $empleados,
            //'facturasislr' => $facturasislr,
            'items' => $items
            //'facts' => $facts
            ))
            ->with('contador', $contador)
            ->with('totalPagosEmpleado', $totalPagosEmpleado)
            ->with('totalFacturasProveedor', $totalFacturasProveedor)
            ->with('facturasCount', $facturasCount);
        //var_dump($proveedor);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$reportesislr = Reporteislr::find($id);
        if (is_null($reportesislr))
        {
            return Redirect::route('islr-reportes.index')
                ->with('global', '<i class="fa fa-exclamation fa-fw x3"></i> Pagina no encontrada');
        }
        $agente = Agente::find(1);
        $empleados = Empleado::all();
        

        return View::make('reportesislr.edit', array(
            'agente' => $agente,
            'empleados' => $empleados
            ))
            ->with('reportesislr', $reportesislr);
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
        $reportesislr = Reporteislr::find($id);
        
        // Si el usuario no existe entonces lanzamos un error 404 :(
        if (is_null($reportesislr))
        {
            App::abort(404);
        }        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($reportesislr->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $reportesislr->fill($data);
            // Guardamos el usuario
            $reportesislr->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('islr-reportes.show', array($reportesislr->id))
                    ->with('editar', 'El reporte I.S.L.R. Nº <b>' . $reportesislr->n_comp . '</b> ha sido actualizado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('islr-reportes.edit', $reportesislr->id)
            		->withInput()
            		->withErrors($reportesislr->errors);
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
		$reportesislr = Reporteislr::find($id);
        
        if (is_null ($reportesislr))
        {
            App::abort(404);
        }
        
        $reportesislr->delete();
        
        return Redirect::route('islr-reportes.index')
            ->with('delete', 'El reporte I.S.L.R. Nº <b>' . $reportesislr->n_comp . '</b> ha sido eliminado correctamente.');
        
	}


}
