<?php

class AgenteTableSeeder extends Seeder {
 
    public function run()
    {
 		date_default_timezone_set('America/Caracas');
        DB::table('agente')->insert(array(
        	'nombre' => 'Nombre de la empresa, C.A.',
            'rif' => 'J-12345678-9',
            'direccion' => 'La dirección de la empresa a registrar',
            'tlf' => '02125555555',
            'comp' => '0000001',
            'compislr' => '1',
            'id_user' => 1,
            'update_user' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'estatus' => 0
        ));
    }
}