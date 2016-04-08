<?php


class Agente extends Eloquent
{

	protected $fillable = array('nombre', 'rif', 'direccion', 'tlf', 'id_user', 'update_user', 'comp', 'compislr', 'estatus');

	public function isValid($data)
    {
        $rules = array(
            'nombre'    => 'required',
            'rif'  		=> 'required|unique:agente',
            'direccion' => 'required',
            'tlf'   	=> 'required',
            'comp'      => 'required|numeric',
            'compislr'  => 'required|numeric'
        );

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el rif del Agente actual
			$rules['rif'] .= ',rif,' . $this->id;
        }        
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

	
	protected $table = 'agente';

	
}
