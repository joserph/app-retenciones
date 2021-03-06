<?php

class Venta extends Eloquent
{
    public function venta(){
        return $this->hasMany('Reportesventa', 'id_fecha');
    }

	protected $fillable = array('fecha_z', 'periodo', 'id_user', 'update_user');

	public function isValid($data)
    {
        $rules = array(
            'fecha_z'   => 'required|unique:ventas',
            'periodo'   => ''
        );

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el rif del Agente actual
			$rules['fecha_z'] .= ',fecha_z,' . $this->id;
        }        
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

	
	protected $table = 'ventas';

	
}
