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
		$reportesIva = DB::table('reportes')->orderBy('id', 'DESC')->where('fecha', '=', $hoy)->get();
		$reportesTodos = DB::table('reportes')->orderBy('n_comp', 'desc')->get();
		$proveedores = Proveedor::all();
		$totalDia = 0;
		$totalMes = 0;
		$contador = 0;
		$reportesIslr = DB::table('reportesislr')->where('fecha', '=', $hoy)->orderBy('fecha', 'desc')->get();
		$empleados = Empleado::all();
		$reportesIslrTodos = DB::table('reportesislr')->orderBy('fecha', 'desc')->get();
		// Suscripcion
		$diaLicencia = date('d', strtotime($agente->hasta));
		$mesLicencia = date('m', strtotime($agente->hasta));
		$anioLicencia = date('Y', strtotime($agente->hasta));
		$licencia = date('Y-m-d', strtotime($agente->hasta));
		$fechaHoy = date('Y-m-d');
		$datetime1 = new DateTime($fechaHoy);
		$datetime2 = new DateTime($licencia);
		$interval = $datetime1->diff($datetime2);
		$resta = $interval->format('%R%a');
		$diasRestante = str_replace("+","",$resta);
		//dd($diasRestante);
		$hoyLicencia = date('d-m-Y');

		if($hoyLicencia == $diaLicencia . '-' . $mesLicencia . '-' . $anioLicencia)
		{
			$mensaje = '<div class="alert alert-warning">
					      	<button type="button" class="close" data-dismiss="alert">×</button>
							<p>Hasta hoy ' . date("d/m/Y", strtotime($hoyLicencia)) . ' puedes usar la aplicación</p>
					    </div>';
		}elseif($diasRestante <= 30)
		{
			$mensaje = '<div class="alert alert-warning">
					      	<button type="button" class="close" data-dismiss="alert">×</button>
							<p>Te quedan ' . $diasRestante . ' días de suscripción, Por favor ponte en contacto con <b>joserph.a@gmail.com<b></p>
					    </div>';
		}else{
			$mensaje = '';
		}
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
			->with('anio', $anio)
			->with('mensaje', $mensaje);
		
		//return var_dump($reportesTodos);
	}

}
