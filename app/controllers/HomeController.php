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
		$reportesIva = DB::table('reportes')->where('fecha', '=', $hoy)->get();
		$proveedores = Proveedor::all();
		foreach ($reportesIva as $item) {
			$totalFacturas = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('total_compra');
		}
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
			'proveedores' => $proveedores
		))
			->with('contador', $contador)
			->with('totalFacturas', $totalFacturas)
			->with('hoy', $hoy);
		
		//return var_dump($totalFacturas);
	}

}
