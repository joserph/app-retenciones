<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesislrTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reportesislr', function($table)
		{
		    $table->increments('id');

		    $table->string('n_comp');
		    $table->string('secuencia');
            $table->date('fecha');
            $table->string('periodo');
            $table->integer('id_agente');
            $table->integer('id_empleado');
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
		Schema::dropIfExists('reportesislr');
	}

}
