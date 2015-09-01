<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Agente extends Eloquent implements UserInterface, RemindableInterface 
{

	protected $fillable = array('nombre', 'rif', 'direccion', 'tlf', 'id_user', 'update_user', 'comp', 'compislr');

	use UserTrait, RemindableTrait;

	public function isValid($data)
    {
        $rules = array(
            'nombre'    => 'required',
            'rif'  		=> 'required|unique:agente',
            'direccion' => 'required',
            'tlf'   	=> 'required',
            'comp'      => 'required',
            'compislr'  => 'required'
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
