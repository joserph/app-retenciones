<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesventasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reportesventas', function($table)
		{
		    $table->increments('id');
                  
          	$table->string('total_v');
          	$table->string('tributado');
          	$table->string('exento');
          	$table->string('impuesto');          	   	
          	$table->integer('id_user');
          	$table->integer('update_user');
          	$table->integer('id_fecha')->unsigned();
          	$table->foreign('id_fecha')->references('id')->on('ventas')->onDelete('cascade');
          
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
		Schema::dropIfExists('reportesventas');
	}

}
