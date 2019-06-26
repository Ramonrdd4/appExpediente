<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //se crea un objeto de tipo usuario, pueden ser varios, cuando hay un :: es un facade
       $objetoUsuario= \App\User::create([
        'nobre'=>'usuario1',
        'correo'=>'usuario@gmail.com',
        'password'=>'usario123',
        'role_id'=>1
    ]);
    }
}
