<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Reportesventa extends Eloquent implements UserInterface, RemindableInterface 
{
	protected $fillable = array('total_v', 'tributado', 'exento', 'impuesto', 'id_user', 'update_user', 'id_fecha');

	use UserTrait, RemindableTrait;

	public function isValid($data)
    {
        $rules = array(
            'total_v'       =>   'required',
            'tributado'     =>   'required',
            'exento'        =>   'required',
            'impuesto'      =>   'required',
            'id_fecha'      =>   '',                
            'id_user'       =>   '',
            'update_user'   =>   'required'
        );     
        
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
