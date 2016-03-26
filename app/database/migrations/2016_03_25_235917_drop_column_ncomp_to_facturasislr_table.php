<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnNcompToFacturasislrTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('facturasislr', function($table)
		{
		    $table->dropColumn('n_comp');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('facturasislr', function($table)
		{
		    $table->string('n_comp');
		});
	}

}
