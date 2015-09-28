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
          	$table->string('n_factura');
          	$table->string('n_codigo');
          	$table->string('n_comp');
          	$table->string('n_control');          	
          	$table->float('total_compra');  
          	$table->float('objreten');           	
          	$table->float('base_imp');
          	$table->float('iva');
          	$table->float('impuesto_iva'); 
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
