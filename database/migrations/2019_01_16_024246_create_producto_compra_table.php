<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_producto')->unsigned();
            $table->integer('id_compra')->unsigned();
            $table->integer('cantidad');
            $table->float('precio_bruto', 8, 2);  //sin iva
            $table->float('iva', 8, 2);
            $table->float('d1', 3, 2)->default(0);
            $table->float('d2', 3, 2)->default(0);
            $table->float('d3', 3, 2)->default(0);
            $table->float('total_dcto', 3, 2)->default(0);
            $table->float('precio_neto', 8, 2);     //con iva + descuentos
            $table->integer('por')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade');
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
        Schema::dropIfExists('producto_compra');
    }
}
