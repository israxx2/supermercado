<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivoComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivo_compras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_compra')->unsigned();
            $table->string('nombre_original');
            $table->integer('por')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_compra')->references('id')->on('compras')->onDelete('cascade');
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
        Schema::dropIfExists('archivo_compras');
    }
}
