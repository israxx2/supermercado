<?php

use Illuminate\Database\Seeder;

class SidebarMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sidebar_menu')->insert([
    		'nombre' => 'Personas',
    		'url' => "#",
            'orden' => 1,
    		'id_rol' => 1,
    		'icono' => "fa fa-users",
    		'por' => 1,
    	]);

    	DB::table('sidebar_menu')->insert([
    		'nombre' => 'registrar persona',
    		'url' => "/user/create",
            'orden' => 1,
    		'id_padre' => 1,
    		'id_rol' => 1,
    		'icono' => "fa fa-circle-o text-green",
    		'por' => 1,
    	]);

    	DB::table('sidebar_menu')->insert([
    		'nombre' => 'Ver persona',
    		'url' => "/user",
            'orden' => 2,
    		'id_padre' => 1,
    		'id_rol' => 1,
    		'icono' => "fa fa-circle-o text-yellow",
    		'por' => 1,
    	]);

        DB::table('sidebar_menu')->insert([
            'nombre' => 'Roles',
            'url' => "/role",
            'orden' => 1,
            'id_rol' => 2,
            'icono' => "fa fa-paperclip",
            'por' => 1,
        ]);
    }
}