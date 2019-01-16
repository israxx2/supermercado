<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_familia')->unsigned();
            $table->string('codigo');
            $table->string('nombre');
            $table->float('precio_bruto', 8, 2);  //sin iva
            $table->float('iva', 8, 2);
            $table->float('precio_neto', 8, 2);     //con iva
            $table->float('costes_adicionales', 8, 2);
            $table->float('precio_total', 8, 2);
            $table->boolean('oferta');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_familia')->references('id')->on('familias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
