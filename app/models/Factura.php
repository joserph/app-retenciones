<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Factura extends Eloquent implements UserInterface, RemindableInterface 
{

    public function reporte()
    {
        return $this->belongsTo('Reporte', 'id_reporte');
    }

	protected $fillable = array(
        'factura',
        'id_reporte',
        'fecha_fac',
        'n_factura',
        'n_control',
        'n_nota_debito',
        'n_nota_credito',
        'tipo_transa',
        'n_fact_ajustada',
        'total_compra',
        'exento',
        'base_imp',
        'iva',
        'impuesto_iva',
        'iva_retenido',
        'id_proveedor',
        'id_user', 
        'update_user'
        );

	use UserTrait, RemindableTrait;

	public function isValid($data)
    {
        $rules = array(
            'factura'           =>  'unique:facturas',
            'fecha_fac'         =>  '',
            'n_factura'         =>  '',
            'n_control'         =>  '',
            'n_nota_debito'     =>  '',
            'n_nota_credito'    =>  '',
            'tipo_transa'       =>  '',
            'n_fact_ajustada'   =>  '',
            'total_compra'      =>  '',
            'exento'            =>  '',
            'base_imp'          =>  '',
            'iva'               =>  '',
            'impuesto_iva'      =>  '',
            'iva_retenido'      =>  ''
        );

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el rif del Agente actual
			$rules['factura'] .= ',factura,' . $this->id;
        }        
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

	
	protected $table = 'facturas';

	
}
