<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Proveedor extends Eloquent implements UserInterface, RemindableInterface 
{
    public function reportes()
    {
        return $this->hasMany('Reporte', 'id_proveedor');
    }

	protected $fillable = array('nombre', 'rif', 'direccion', 'porcentaje', 'id_user', 'update_user');

	use UserTrait, RemindableTrait;

	public function isValid($data)
    {
        $rules = array(
            'nombre'    => 'required',
            'rif'  		=> 'required|unique:proveedores',
            'direccion' => 'required',
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

	
	protected $table = 'proveedores';

	
}
