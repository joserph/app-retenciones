<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('agente', function($table)
		{
		    $table->increments('id');

		    $table->string('nombre');
		    $table->string('rif');
		    $table->string('direccion', 400);
		    $table->string('tlf');	
		    $table->string('comp');	
		    $table->string('compislr');	     
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
		Schema::dropIfExists('agente');
	}

}
