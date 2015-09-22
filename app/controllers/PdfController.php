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
		$reportesislr = Reporteislr::find($id);
		$facturasislr = DB::table('facturasislr')->where('id_reporteislr', '=', $id)->get();
		$agentes = Agente::find(1);
		$proveedores = Empleado::all();
		$pdf = PDF::loadView('pdfislr', array(
			'reportesislr' => $reportesislr, 
			'facturasislr' => $facturasislr, 
			'agentes' => $agentes,
			'proveedores' => $proveedores
			))->setPaper('Carta')->setOrientation('landscape');
		return $pdf->stream();
	}

}
