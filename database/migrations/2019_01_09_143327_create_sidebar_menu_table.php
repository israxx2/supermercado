<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSidebarMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidebar_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('url')->default('#');
            $table->integer('id_padre')->unsigned()->default(0);
            $table->integer('id_rol')->unsigned();
            $table->integer('orden')->default(0);
            $table->string('icono');
            $table->integer('por')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('por')->references('id')->on('users');
            $table->foreign('id_rol')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sidebar_menu');
    }
}
