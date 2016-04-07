<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuscripcionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suscripcion', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('nombre');
			$table->string('email');
			$table->date('desde');
			$table->date('hasta');
			$table->string('estatus');
			$table->string('code');
			$table->integer('id_user');
			$table->integer('update_user');
			
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('suscripcion');
	}

}
