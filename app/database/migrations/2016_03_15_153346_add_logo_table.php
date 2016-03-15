<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logo', function (Blueprint $table) {
		    $table->increments('id');
		    
		    $table->string('nombre', 200);
		    $table->string('ruta', 500);
		    $table->string('extension', 5);
		    $table->integer('id_agente');
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
		Schema::dropIfExists('logo');
	}

}
