<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Iva extends Eloquent implements UserInterface, RemindableInterface 
{

	protected $fillable = array('iva', 'id_user', 'estatus', 'vigencia', 'update_user');

	use UserTrait, RemindableTrait;

	public function isValid($data)
    {
        $rules = array(
            'iva'       => 'required',
            'estatus'   => 'required',
            'vigencia'  => 'required'
        );       
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

	
	protected $table = 'impuesto';

	
}
