<?php

class PdfController extends BaseController {

	public function getIndexIva($id)
	{
		$reportes = DB::table('reportes')->where('id', '=', $id)->first();
		$facturas = DB::table('facturas')->where('id_reporte', '=', $id)->get();
		$agentes = Agente::find(1);
		$proveedor = DB::table('proveedores')->where('id', '=', $reportes->id_proveedor)->first();
		$pdf = PDF::loadView('pdfs.pdfiva', array(
			'reportes' => $reportes, 
			'facturas' => $facturas, 
			'agentes' => $agentes,
			'proveedor' => $proveedor
			))->setPaper('Carta')->setOrientation('landscape');
		return $pdf->stream();
	}

	public function getIndexIslr($id)
	{
		$reportesislr = DB::table('reportesislr')->where('id', '=', $id)->first();
		$facturasislr = DB::table('facturasislr')->where('id_reporteislr', '=', $id)->get();
		$agente = Agente::find(1);
		$proveedor = DB::table('empleados')->where('id', '=', $reportesislr->id_empleado)->first();
		$contador = 0;
		$pdf = PDF::loadView('pdfs.pdfislr', array(
			'reportesislr' => $reportesislr, 
			'facturasislr' => $facturasislr, 
			'agente' => $agente,
			'proveedor' => $proveedor
			))->setPaper('Carta')->setOrientation('landscape');
		return $pdf->stream();
		//var_dump($proveedor);
	}

}
