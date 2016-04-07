<?php

class Reporte extends Eloquent
{
    public function facturas()
    {
        return $this->hasMany('Factura', 'id_reporte');
    }

	protected $fillable = array('n_comp', 'secuencia', 'fecha', 'periodo', 'id_agente', 'iva', 'id_proveedor', 'id_user', 'update_user');

	public function isValid($data)
    {
        $rules = array(
            'n_comp'        => 'required|numeric|unique:reportes',
            'secuencia'     => 'required|numeric',
            'fecha'  		=> 'required',
            'periodo'       => 'required',
            'id_agente'   	=> 'required',
            'id_proveedor'  => 'required'
        );

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el rif del Agente actual
			$rules['n_comp'] .= ',n_comp,' . $this->id;
        }        
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }
	
	protected $table = 'reportes';

	
}
