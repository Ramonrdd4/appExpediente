<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfil= App\Profile::create([
            'id'=>116850044,
            'nombre'=>'Jose',
            'primerApellido'=>'Rodriguez',
            'primerApellido'=>'Rodriguez',
            'sexo'=>'masculino',
            'fechaNacimiento'=>'08/28/1997',
            'tipoSangre'=>'B+',
            'direccion'=>'Atenas, Los angeles, los espabeles.',
            'numTelefonico'=>71999106,
            'contactoEmergencia'=>83794686,
            'idUsuario'=>'jose@gmail.com',
            'esDuenho'=>true,
        ]);
    }
}
