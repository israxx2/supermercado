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
            $table->integer('id_proveedor')->unsigned();
            $table->integer('stock');
            $table->string('codigo')->nullable();
            $table->string('nombre');
            $table->string('imagen')->default('default.jpg');
            $table->string('descripcion')->nullable();
            $table->boolean('autorizado')->default(1);
            $table->integer('por')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_familia')->references('id')->on('familias')->onDelete('cascade');
            $table->foreign('id_proveedor')->references('id')->on('proveedores')->onDelete('cascade');
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
        Schema::dropIfExists('productos');
    }
}
