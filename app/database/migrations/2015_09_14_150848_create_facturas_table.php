<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facturas', function($table)
            {
                  $table->increments('id');

                  $table->string('factura');
                  $table->string('n_comp');
                  $table->date('fecha_fac');
                  $table->string('n_factura');
                  $table->string('n_control');
                  $table->string('n_nota_debito');
                  $table->string('n_nota_credito');
                  $table->string('tipo_transa');
                  $table->string('n_fact_ajustada');
                  $table->decimal('total_compra', 12, 2);
                  $table->decimal('exento', 15, 2);
                  $table->decimal('base_imp', 15, 2);
                  $table->decimal('iva');
                  $table->decimal('impuesto_iva', 15, 2);
                  $table->decimal('iva_retenido', 15, 2);
                  $table->integer('id_proveedor');
                  $table->integer('id_user');
                  $table->integer('update_user');
                  $table->integer('id_reporte')->unsigned();
                  $table->foreign('id_reporte')->references('id')->on('reportes')->onDelete('cascade');

                  
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
		Schema::dropIfExists('facturas');
	}

}
