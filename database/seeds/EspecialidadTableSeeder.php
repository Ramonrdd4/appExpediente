<?php

use Illuminate\Database\Seeder;

class EspecialidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $especialidad = new App\Especialidad();
        $especialidad->nombre='Pediatria';
        $especialidad->descripcion='Niños';
        $especialidad->save();
        //2
        $especialidad = new App\Especialidad();
        $especialidad->nombre='Psiquiatría ';
        $especialidad->descripcion='Mente';
        $especialidad->save();
        //3
        $especialidad = new App\Especialidad();
        $especialidad->nombre='Urología';
        $especialidad->descripcion='aparato urinario y retroperitoneo de ambos sexos';
        $especialidad->save();
        //4
        $especialidad = new App\Especialidad();
        $especialidad->nombre='Oncología ';
        $especialidad->descripcion='La oncología es la especialidad médica dedicada con el diagnóstico y tratamiento del cáncer.';
        $especialidad->save();
        //5
        $especialidad = new App\Especialidad();
        $especialidad->nombre='Oftalmología';
        $especialidad->descripcion='Visión.';
        $especialidad->save();
        //6
        $especialidad = new App\Especialidad();
        $especialidad->nombre='Ginecología';
        $especialidad->descripcion='sistema reproductor femenino (útero, vagina y ovarios) y de la reproducción.';
        $especialidad->save();
        //7
        $especialidad = new App\Especialidad();
        $especialidad->nombre='Dermatología';
        $especialidad->descripcion='La dermatología es la especialidad médica encargada del estudio de la piel';       $especialidad->save();
        //8
        $especialidad = new App\Especialidad();
        $especialidad->nombre='General';
        $especialidad->descripcion='Brindar servicios médicos preventivos y curativos, atendiento y examinando a pacientes en general';
        $especialidad->save();
    }
}
