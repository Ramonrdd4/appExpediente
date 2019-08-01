<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            'segundoApellido'=>'Rodriguez',
            'sexo'=>'masculino',
            'fechaNacimiento'=> Carbon::create('1997', '08', '28'),
            'tipoSangre'=>'B+',
            'direccion'=>'Atenas, Los angeles, los espabeles.',
            'numTelefonico'=>71999106,
            'contactoEmergencia'=>83794686,
            'idUsuario'=>2,
            'esDuenho'=>true,
        ]);
        $perfil->save();

        $perfil = App\Profile::create([
            'id'=>116850045,
            'nombre'=>'Valeria',
            'primerApellido'=>'Tapia',
            'segundoApellido'=>'Calvo',
            'sexo'=>'femenino',
            'fechaNacimiento'=> Carbon::create('1997', '02', '19'),
            'tipoSangre'=>'A+',
            'direccion'=>'La giralda, 2da entrada despues de la rotonda',
            'numTelefonico'=>60271942,
            'contactoEmergencia'=>83794686,
            'idUsuario'=>2,
            'esDuenho'=>false,
        ]);

        $perfil = App\Profile::create([
            'id'=>116850046,
            'nombre'=>'Raymundo',
            'primerApellido'=>'Rodriguez',
            'segundoApellido'=>'Rodriguez',
            'sexo'=>'masculino',
            'fechaNacimiento'=> Carbon::create('1992', '10', '24'),
            'tipoSangre'=>'B+',
            'direccion'=>'Atenas, Los angeles, los espabeles.',
            'numTelefonico'=>87643661,
            'contactoEmergencia'=>83794686,
            'idUsuario'=>2,
            'esDuenho'=>false,
        ]);

    }
}
