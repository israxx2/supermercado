<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->increments('id');
            $table->float('precio_anterior', 8, 2);
            $table->float('precio_oferta', 8, 2);
            $table->float('porcentaje');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_final');
            $table->integer('por')->unsigned();
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('ofertas');
    }
}
