<?php

use Illuminate\Database\Seeder;
use App\Desease;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1.
        $desease= new App\Desease();
        $desease->nombre='Dengue';
        $desease->observaciones='Transmitida por el mosquido Aedes Aegyptis';
        $desease->listaId=1;
        $desease->save();
        //2.
        $desease= new App\Desease();
        $desease->nombre='Chikunguya';
        $desease->observaciones='Alrededor de 1500 casos por año';
        $desease->listaId=1;
        $desease->save();
        //3.
        $desease= new App\Desease();
        $desease->nombre='Diarreas';
        $desease->observaciones='Producida por bacterias en los intestinos';
        $desease->listaId=1;
        $desease->save();
        //4.
        $desease= new App\Desease();
        $desease->nombre='Hepatitis';
        $desease->observaciones='Puede ser causada por infecciones o respuesta inmunitaria';
        $desease->listaId=1;
        $desease->save();
        //5.
        $desease= new App\Desease();
        $desease->nombre='Tuberculosis';
        $desease->observaciones='Puede presentar sudores nocturnos';
        $desease->listaId=1;
        $desease->save();
        //6.
        $desease= new App\Desease();
        $desease->nombre='Diabetes';
        $desease->observaciones='Presenta tambien muchas ganas de orinar';
        $desease->listaId=1;
        $desease->save();
        //7.
        $desease= new App\Desease();
        $desease->nombre='Hipertensión';
        $desease->observaciones='Presenta tambien obesidad';
        $desease->listaId=1;
        $desease->save();
        //8.
        $desease= new App\Desease();
        $desease->nombre='Artritis';
        $desease->observaciones='Afecta specialmente las rodillas';
        $desease->listaId=1;
        $desease->save();
        //9.
        $desease= new App\Desease();
        $desease->nombre='Cancer de mama';
        $desease->observaciones='Podria ser hereditario';
        $desease->listaId=1;
        $desease->save();
        //10.
        $desease= new App\Desease();
        $desease->nombre='Mal de Charcot';
        $desease->observaciones='Hereditario';
        $desease->listaId=1;
        $desease->save();
        //11.
        $desease= new App\Desease();
        $desease->nombre='Fiebre amarilla';
        $desease->observaciones='Transmitida por un mosquito, muy común en África';
        $desease->save();
        //12.
        $desease= new App\Desease();
        $desease->nombre='Fiebre Tifoidea';
        $desease->observaciones='Fibre elevada y síntomas abdominales';
        $desease->save();
        //13.
        $desease= new App\Desease();
        $desease->nombre='VPH';
        $desease->observaciones='La ETS más común';
        $desease->save();
        //14.Colitis
        $desease= new App\Desease();
        $desease->nombre='Colitis';
        $desease->observaciones='Puede ser causada por estrés';
        $desease->save();
    }
}
