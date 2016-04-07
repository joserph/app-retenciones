<?php

class Facturaislr extends Eloquent
{
     public function reporteislr()
    {
        return $this->belongsTo('Reporteislr', 'id_reporteislr');
    }
	protected $fillable = array(
        'id_reporteislr',
        'fecha_fac',
        'n_factura',
        'n_codigo',
        'n_comp',   
        'n_control',        
        'total_compra',
        'objreten',
        'base_imp',
        'iva',
        'impuesto_iva',
        'tipo',
        'id_proveedor',
        'id_user', 
        'update_user'
        );

	public function isValid($data)
    {
        $rules = array(
            'fecha_fac'         =>  '',
            'n_factura'         =>  'unique:facturasislr',
            'n_control'         =>  '',
            'total_compra'      =>  '',
            'base_imp'          =>  '',
            'iva'               =>  '',
            'impuesto_iva'      =>  ''
        );

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el rif del Agente actual
			$rules['n_factura'] .= ',n_factura,' . $this->id;
        }        
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

	
	protected $table = 'facturasislr';

	
}
