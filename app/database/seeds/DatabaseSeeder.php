<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('AgenteTableSeeder');
		$this->call('IvaTableSeeder');
		$this->call('ProveedorTableSeeder');
        
        $this->command->info('All table seeded!');
	}

}
