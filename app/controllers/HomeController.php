<?php

class HomeController extends BaseController {


	public function home()
	{
		$agente = Agente::find(1);
		$totalAgente = DB::table('agente')->count();
		return View::make('home', array(
			'agente' => $agente,
			'totalAgente' => $totalAgente
		));
	}

}
