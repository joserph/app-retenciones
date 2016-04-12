<?php

class Reportesventa extends Eloquent
{
	protected $fillable = array('total_v', 'tributado', 'exento', 'impuesto', 'id_user', 'update_user', 'id_fecha', 'n_zetas', 'zeta');

	public function isValid($data)
    {
        $rules = array(
            'total_v'       =>   'required|numeric',
            'tributado'     =>   'required|numeric',
            'exento'        =>   'required|numeric',
            'impuesto'      =>   'required|numeric',
            'id_fecha'      =>   '',                
            'id_user'       =>   '',
            'update_user'   =>   'required',
            'n_zetas'       =>   'required|numeric',
            'zeta'          =>   'required|unique:reportesventas'
        ); 

         if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el rif del Agente actual
            $rules['zeta'] .= ',zeta,' . $this->id;
        }       
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }
	
	protected $table = 'reportesventas';

	
}
