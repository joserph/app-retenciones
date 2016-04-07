<?php

class Iva extends Eloquent
{

	protected $fillable = array('iva', 'id_user', 'estatus', 'vigencia', 'update_user');

	public function isValid($data)
    {
        $rules = array(
            'iva'       => 'required|numeric',
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
