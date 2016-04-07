<?php

class Suscripcion extends Eloquent
{

	protected $fillable = array('nombre', 'email', 'desde', 'hasta');

    protected $hidden = array('estatus', 'code', 'id_user', 'update_user');
    
	public function isValid($data)
    {
        $rules = array(
            'nombre'    =>  'required',
            'email'     =>  'required|email|unique:suscripcion',
            'desde'     =>  'required',
            'hasta'     =>  'required'
        );

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el rif del Agente actual
			$rules['email'] .= ',email,' . $this->id;
        }        
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

	
	protected $table = 'suscripcion';

	
}
