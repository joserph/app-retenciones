<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empleados', function($table)
        {
            $table->increments('id');
              
            $table->string('tipo');
            $table->string('nombre');
		    $table->string('rif');
		    $table->string('direccion', 400);
		    $table->string('porcentaje', 10);	
		    $table->string('tlf', 15);    
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
		Schema::dropIfExists('empleados');
	}

}
