<?php

class Reporteislr extends Eloquent
{
     public function facturasislr(){
        return $this->hasMany('Facturaislr', 'id_reporteislr');
    }

	protected $fillable = array('n_comp', 'secuencia', 'fecha', 'periodo', 'id_agente', 'id_proveedor', 'id_user', 'update_user', 'id_empleado');

	public function isValid($data)
    {
        $rules = array(
            'n_comp'        => 'required|unique:reportesislr',
            'secuencia'     => 'required',
            'fecha'  		=> 'required',
            'periodo'       => 'required',
            'id_agente'   	=> 'required',
            'id_empleado'   => 'required'
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
	
	protected $table = 'reportesislr';

	
}
