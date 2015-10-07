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
		$reportesTodos = Reporte::all();
		$proveedores = Proveedor::all();
		$totalDia = 0;
		$totalMes = 0;
		$contador = 0;
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
			'reportesTodos' => $reportesTodos
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
