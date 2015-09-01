<?php

class AgenteTableSeeder extends Seeder {
 
    public function run()
    {
 		date_default_timezone_set('America/Caracas');
        DB::table('agente')->insert(array(
        	'nombre' => 'Distribuidora Mega Maxi, C.A.',
            'rif' => 'J-31010287-2',
            'direccion' => 'Calle Atras de Antimano, Edif. La princesa, PB, Local 8, Antimano',
            'tlf' => 02124722640,
            'comp' => 0000001,
            'compislr' => 1,
            'id_user' => 1,
            'update_user' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ));
    }
}