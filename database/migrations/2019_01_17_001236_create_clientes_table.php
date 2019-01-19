<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut')->nullable();
            $table->string('nombre');
            $table->string('email')->nullable();
            $table->string('cod_postal')->nullable();
            $table->string('telefono')->nullable();
            $table->string('num_fax')->nullable();
            $table->string('direccion')->nullable();
            $table->string('id_ciudad')->nullable();
            $table->sting('observacion');
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
        Schema::dropIfExists('clientes');
    }
}
