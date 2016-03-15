<?php

class AgenteTableSeeder extends Seeder {
 
    public function run()
    {
 		date_default_timezone_set('America/Caracas');
        DB::table('logo')->insert(array(
        	'nombre' => 'logo',
            'ruta' => '',
            'extension' => 'jpg',
            'id_agente' => 1,
            'id_user' => 1,
            'update_user' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ));
    }
}