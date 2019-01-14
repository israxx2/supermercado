<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
            'name' => 'Eduardo Israel',
            'apellido' => 'Gonzalez Troncoso',
            'email' => 'admin1@ucm.cl',
            'rut' => '19105900k',
            'id_rol' => 1,
            'password' => bcrypt('asdqwe123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Carlos Eduardo',
            'apellido' => 'Gonzalez Gajardo',
            'email' => 'admin2@ucm.cl',
            'rut' => '123456789',
            'id_rol' => 2,
            'password' => bcrypt('asdqwe123'),
        ]);

        factory(App\User::class, 5)->create([
            'id_rol' => 3
        ]);

    }
}
