<?php

class ProveedorTableSeeder extends Seeder {
 
    public function run()
    {
 		date_default_timezone_set('America/Caracas');
        DB::table('proveedores')->insert(array(
        	'nombre'        => 'Nombre del Proveedor C.A.',
            'rif'           => 'J-98765432-1',
            'direccion'     => 'La dirección del proveedor.',
            'porcentaje'    => '75',
            'id_user'       => 1,
            'update_user'   => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ));
    }
}