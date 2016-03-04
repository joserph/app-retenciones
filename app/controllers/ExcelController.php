<?php

class ExcelController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$reportes = Reporte::all();
		$reporteUno = Reporte::find(1);
		$iuno = date('Y', strtotime($reporteUno->fecha));
		$anio = date('Y');	
		$tipoA = 'A';
		$tipoB = 'B';	
		
		return View::make('excel.index')
			->with('reportes', $reportes)
			->with('tipoA', $tipoA)
			->with('tipoB', $tipoB);
	}


	public function getGenerate($tipo, $periodo)
	{
		$reportes = DB::table('reportes')->where('periodo', '=', $periodo)->get();

		
		
		foreach($reportes as $item)
		{
			if(date('d', strtotime($item->fecha)) < 16)
			{
				Excel::create('Laravel Excel', function($excel) 
				{ 
		            $excel->sheet('Reportes', function($sheet) 
		            { 		 
		            	$periodo = $this->$periodo;
		                $reportes = DB::table('reportes')->get();
		 				
		 				$sheet->loadView('excel.show')
		 					->with('reportes', $reportes)
		 					->with('periodo', $periodo);		 
		            });
		        })->export('xls');
			}
		}
	}


}
