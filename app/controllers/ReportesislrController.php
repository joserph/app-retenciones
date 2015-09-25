<?php

class ReportesislrController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
        $reportesislr = DB::table('reportesislr')->orderBy('created_at', 'desc')->paginate(10);        
        
        $agente = Agente::find(1);
        $contador = 0;
		return View::make('reportesislr.index',array(
            'reportesislr' => $reportesislr,
            
            'agente' => $agente
        ))->with('contador', $contador);
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
        $proveedor = DB::table('proveedores')->where('id', '=', $reportesislr->id_proveedor)->first();
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
            return Redirect::route('reportesislr.show', array($reportesislr->id))
                    ->with('create', 'El reporte de I.S.L.R. ha sido creado correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('reportesislr.create', array($reportesislr->id))
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
