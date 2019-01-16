<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_control', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('por')->unsigned();
            $table->enum('tipo',['ENTRADA', 'SALIDA']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('por')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_control');
    }
}
