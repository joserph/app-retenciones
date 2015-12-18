<?php

class HomeController extends BaseController {

	public function home()
	{
		$agente = Agente::find(1);
		$totalAgente = DB::table('agente')->count();
		$iva = DB::table('impuesto')->where('estatus', '=', 'actual')->first();
		date_default_timezone_set('America/Caracas');
		$dia = date('d');
		$mes = date('m');
		$anio = date('Y');
		$hoy = $anio .'-'. $mes .'-'. $dia;
		$mesActual = $anio .'-'. $mes;
		$reportesIva = DB::table('reportes')->where('fecha', '=', $hoy)->get();
		$reportesTodos = DB::table('reportes')->orderBy('fecha', 'desc')->get();
		$proveedores = Proveedor::all();
		$totalDia = 0;
		$totalMes = 0;
		$contador = 0;
		$reportesIslr = DB::table('reportesislr')->where('fecha', '=', $hoy)->orderBy('fecha', 'desc')->get();
		$empleados = Empleado::all();
		$reportesIslrTodos = DB::table('reportesislr')->orderBy('fecha', 'desc')->get();
		if(is_null($iva))
		{
			$iva = 'vencido';
		}
		return View::make('home', array(
			'agente' => $agente,
			'totalAgente' => $totalAgente,
			'iva' => $iva,
			'reportesIva' => $reportesIva,
			'proveedores' => $proveedores,
			'reportesTodos' => $reportesTodos,
			'reportesIslr' => $reportesIslr,
			'empleados' => $empleados,
			'reportesIslrTodos' => $reportesIslrTodos
		))
			->with('contador', $contador)
			->with('totalDia', $totalDia)
			->with('totalMes', $totalMes)
			->with('hoy', $hoy)
			->with('mes', $mes)
			->with('anio', $anio);
		
		//return var_dump($reportesTodos);
	}

}
