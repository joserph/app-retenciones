<?php


class Factura extends Eloquent
{

    public function reporte()
    {
        return $this->belongsTo('Reporte', 'id_reporte');
    }

    public function proveedor()
    {
        return $this->belongsTo('Proveedor', 'id_proveedor');
    }

	protected $fillable = array(
        'factura',
        'id_reporte',
        'fecha_fac',
        'n_factura',
        'n_control',
        'n_nota_debito',
        'n_nota_credito',
        'tipo_transa',
        'n_fact_ajustada',
        'total_compra',
        'exento',
        'base_imp',
        'iva',
        'impuesto_iva',
        'iva_retenido',
        'id_proveedor',
        'id_user', 
        'update_user'
        );

	public function isValid($data)
    {
        $rules = array(
            'factura'           =>  'unique:facturas',
            'fecha_fac'         =>  'required',
            'n_factura'         =>  '',
            'n_control'         =>  'required',
            'n_nota_debito'     =>  '',
            'n_nota_credito'    =>  '',
            'tipo_transa'       =>  'required',
            'n_fact_ajustada'   =>  '',
            'total_compra'      =>  'required|numeric',
            'exento'            =>  'numeric',
            'base_imp'          =>  'numeric',
            'iva'               =>  '',
            'impuesto_iva'      =>  'numeric',
            'iva_retenido'      =>  'numeric'
        );

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el rif del Agente actual
			$rules['factura'] .= ',factura,' . $this->id;
        }        
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

	
	protected $table = 'facturas';

	
}
