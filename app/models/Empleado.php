<?php


class Empleado extends Eloquent
{

	protected $fillable = array('tipo', 'nombre', 'rif', 'direccion', 'tlf', 'porcentaje', 'id_user', 'update_user', 'sustraendo');

	public function isValid($data)
    {
        $rules = array(
            'tipo'      => 'required',
            'nombre'    => 'required',
            'rif'  		=> 'required|unique:empleados',
            'direccion' => 'required',
            'tlf'   	=> 'required',
            'porcentaje'=> 'required|numeric',
            'sustraendo'=> 'numeric'
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
