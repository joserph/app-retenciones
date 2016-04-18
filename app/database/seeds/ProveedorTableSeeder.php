<?php

class ProveedorTableSeeder extends Seeder {
 
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        for ($i = 0; $i < 50; $i++)
        {
            date_default_timezone_set('America/Caracas');
            DB::table('proveedores')->insert(array(
                'nombre'        => $faker->company,
                'rif'           => $faker->numberBetween($min = 1000000, $max = 9000000),
                'direccion'     => $faker->address,
                'porcentaje'    => $faker->numberBetween($min = 0, $max = 100),
                'id_user'       => 1,
                'update_user'   => 1,
                'created_at'    => $faker->dateTime($max = 'now'),
                'updated_at'    => $faker->dateTime($max = 'now')
            ));
        }
 		
    }
}