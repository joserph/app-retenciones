<?php

class Proveedor extends Eloquent
{
    public function reportes()
    {
        return $this->hasMany('Reporte', 'id_proveedor');
    }

    public function facturas()
    {
        return $this->hasMany('Factura', 'id_proveedor');
    }

	protected $fillable = array('nombre', 'rif', 'direccion', 'porcentaje', 'id_user', 'update_user');

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
