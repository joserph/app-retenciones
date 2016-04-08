<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstatusToAgenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('agente', function($table)
		{
		    $table->integer('estatus');
		    $table->date('hasta');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('agente', function($table)
		{
		    $table->dropColumn('estatus');
		    $table->dropColumn('hasta');
		});
	}

}
