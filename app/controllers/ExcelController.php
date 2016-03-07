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
			->with('reportes', $reportes);
	}


	public function getGenerate($tipo, $periodo)
	{
		if($tipo == 'A')
		{
			$reportes = DB::table('reportes')->where('periodo', '=', $periodo)->where('fecha', '<', $periodo. '-16')->get();
		}else{
			$reportes = DB::table('reportes')->where('periodo', '=', $periodo)->where('fecha', '>', $periodo. '-15')->get();
		}
					
		
		Excel::create('Laravel Excel', function($excel) use ($reportes)
		{ 
            $excel->sheet('Reportes', function($sheet) use ($reportes)
            {		 				
 				$sheet->loadView('excel.show')
 					->with('reportes', $reportes);		 
            });
        })->export('xls');
			
	}


}
