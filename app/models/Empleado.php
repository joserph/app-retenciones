<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Empleado extends Eloquent implements UserInterface, RemindableInterface 
{

	protected $fillable = array('tipo', 'nombre', 'rif', 'direccion', 'tlf', 'porcentaje', 'id_user', 'update_user');

	use UserTrait, RemindableTrait;

	public function isValid($data)
    {
        $rules = array(
            'tipo'      => 'required',
            'nombre'    => 'required',
            'rif'  		=> 'required|unique:empleados',
            'direccion' => 'required',
            'tlf'   	=> 'required',
            'porcentaje'=> 'required'
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

	
	protected $table = 'empleados';

	
}
