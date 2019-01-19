<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_producto')->unsigned();
            $table->integer('id_oferta')->unsigned()->nullable();
            $table->float('precio_bruto', 8, 2);  //sin iva
            $table->float('iva', 8, 2);
            $table->float('costes_adicionales', 8, 2)->nullable();
            $table->float('precio_neto', 8, 2);     //con iva
            $table->boolean('actual')->default(1);
            $table->integer('por')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('id_oferta')->references('id')->on('ofertas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precios');
    }
}
