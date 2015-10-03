<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactuasislrTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facturasislr', function($table)
		{
		    $table->increments('id');
                  
          	$table->date('fecha_fac');
          	$table->string('n_factura')->nullable();
          	$table->string('n_codigo')->nullable();
          	$table->string('n_comp')->nullable();
          	$table->string('n_control')->nullable();          	
          	$table->decimal('total_compra', 15, 2);  
          	$table->decimal('objreten', 15, 2)->nullable();           	
          	$table->decimal('base_imp', 15, 2)->nullable();
          	$table->decimal('iva');
          	$table->decimal('impuesto_iva', 15, 2)->nullable(); 
          	$table->string('tipo');    
          	$table->integer('id_proveedor');      	
          	$table->integer('id_user');
          	$table->integer('update_user');
          	$table->integer('id_reporteislr')->unsigned();
          	$table->foreign('id_reporteislr')->references('id')->on('reportesislr')->onDelete('cascade');
          
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
		Schema::dropIfExists('facturasislr');
	}

}
