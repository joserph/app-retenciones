<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Logo extends Eloquent implements UserInterface, RemindableInterface 
{

	protected $fillable = array('nombre', 'ruta', 'extension', 'id_agente', 'id_user');

	use UserTrait, RemindableTrait;

	public function isValid($data)
    {
        $rules = array(
            'nombre'    => 'required',
            'ruta'      => 'required',
            'extension' => 'required|mimes:jpeg'
        );       
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

	
	protected $table = 'logo';

	
}
