<?php

use Illuminate\Database\Seeder;

class AlergiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Alergias de categoria ambiente.
        //1.
        $alergia = new \App\Feature();
        $alergia->nombre='Alergia al polen';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Lagrimeo, picor, enrojecimiento oculuar y conjuntivitis';
        $alergia->observaciones='Respuesta del sistema inmunologico al polen.';
        $alergia->save();
        //2.
        $alergia = new \App\Feature();
        $alergia->nombre='Alergia a los hongos';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Neumonitis por hipersensibilidad.';
        $alergia->observaciones='Posible caso de origen laboral.';
        $alergia->save();
        //3.
        $alergia = new \App\Feature();
        $alergia->nombre='Alergia a los acaros';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Picazón de garganta y/u oídos.';
        $alergia->observaciones='Exposición a lugares llenos de polvo.';
        $alergia->save();
        
    }
}
