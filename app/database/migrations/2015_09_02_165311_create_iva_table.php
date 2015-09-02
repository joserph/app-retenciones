<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIvaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('impuesto', function($table)
        {
              $table->increments('id');
              
              $table->string('iva');
              $table->string('estatus');   
              $table->date('vigencia');             
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
		Schema::dropIfExists('impuesto');
	}

}
