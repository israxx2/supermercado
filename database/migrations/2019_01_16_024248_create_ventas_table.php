<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned()->nullable();
            $table->string('observacion', 255)->nullable();
            $table->float('subtotal', 8, 2);
            $table->float('dcto_total', 8, 2);
            $table->float('iva', 8, 2);
            $table->float('total', 8, 2);
            $table->float('abono', 8, 2);
            $table->integer('por')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('por')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
