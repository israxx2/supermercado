<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('id_proveedor');
            $table->date('fecha_factura');
            $table->integer('id_condicion')->unsigned();
            $table->string('observacion', 255)->nullable();
            $table->float('total', 8, 2);
            $table->float('abono', 8, 2);
            $table->boolean('cancelada')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_proveedor')->references('id')->on('proveedores')->onDelete('cascade');
            $table->foreign('id_condicion')->references('id')->on('condiciones_pago')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
