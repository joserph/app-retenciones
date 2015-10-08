<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ventas', function($table)
		{
		    $table->increments('id');
                  
          	$table->date('fecha_z');
          	$table->date('periodo');
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
		Schema::dropIfExists('ventas');
	}

}
