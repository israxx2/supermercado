<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'rol' => 'administrador'
        ]);

        DB::table('roles')->insert([
            'rol' => 'dueño'
        ]);

        DB::table('roles')->insert([
            'rol' => 'trabajador'
        ]);
    }
}
