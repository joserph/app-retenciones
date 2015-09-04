<?php

class HomeController extends BaseController {

	public function home()
	{
		$agente = Agente::find(1);
		$totalAgente = DB::table('agente')->count();
		$iva = DB::table('impuesto')->where('estatus', '=', 'actual')->first();
		if(is_null($iva))
		{
			$iva = 'vencido';
		}
		return View::make('home', array(
			'agente' => $agente,
			'totalAgente' => $totalAgente,
			'iva' => $iva
		));
	}

}
