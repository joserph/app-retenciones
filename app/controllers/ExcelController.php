<?php

class ExcelController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{		
		return View::make('excel.index');
	}

	public function postIndex()
	{
		//$data = Input::all();
		$dateFrom = Input::get('fecha_i');
		$dateTo = Input::get('fecha_f');
		$reportes = Reporte::where('fecha', '>=', $dateFrom)->where('fecha', '<=', $dateTo)->get();
		
		return View::make('excel.show')
			->with('reportes', $reportes)
			->with('dateFrom', $dateFrom)
			->with('dateTo', $dateTo);
	}


	public function getGenerate($desde, $hasta)
	{
		$reportes = Reporte::where('fecha', '>=', $desde)->where('fecha', '<=', $hasta)->get();			
		$facturas = Factura::all();
		$agente = Agente::find(1);
		$proveedores = Proveedor::all();
		$code		= str_random(10);
		Excel::create('Facturas desde ' . $desde . ' hasta ' . $hasta . '-' . $code, function($excel) use ($reportes, $facturas, $agente, $proveedores)
		{ 
            $excel->sheet('Reportes', function($sheet) use ($reportes, $facturas, $agente, $proveedores)
            {		 				
 				$sheet->loadView('excel.generate')
 					->with('reportes', $reportes)
 					->with('facturas', $facturas)
 					->with('agente', $agente)
 					->with('proveedores', $proveedores);		 
            });
        })->export('xls');
			
	}


}
