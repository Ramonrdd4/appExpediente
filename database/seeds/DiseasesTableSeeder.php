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
        $disease= new App\Desease;
        $desease->nombre('Dengue');
        $desease->observaciones('Transmitida por el mosquido Aedes Aegyptis');
        $desease->save();
        //2.
        $disease= new App\Desease;
        $desease->nombre('Chikunguya');
        $desease->observaciones('Alrededor de 1500 casos por año');
        $desease->save();
        //3.
        $disease= new App\Desease;
        $desease->nombre('Diarreas');
        $desease->observaciones('Producida por bacterias en los intestinos');
        $desease->save();
        //4.
        $disease= new App\Desease;
        $desease->nombre('Hepatitis');
        $desease->observaciones('Puede ser causada por infecciones o respuesta inmunitaria');
        $desease->save();
        //5.
        $disease= new App\Desease;
        $desease->nombre('Tuberculosis');
        $desease->observaciones('Puede presentar sudores nocturnos');
        $desease->save();
        //6.
        $disease= new App\Desease;
        $desease->nombre('Diabetes');
        $desease->observaciones('Presenta tambien muchas ganas de orinar');
        $desease->save();
        //7.
        $disease= new App\Desease;
        $desease->nombre('Hipertensión');
        $desease->observaciones('Presenta tambien obesidad');
        $desease->save();
        //8.
        $disease= new App\Desease;
        $desease->nombre('Artritis');
        $desease->observaciones('Afecta specialmente las rodillas');
        $desease->save();
        //9.
        $disease= new App\Desease;
        $desease->nombre('Cancer de mama');
        $desease->observaciones('Podria ser hereditario');
        $desease->save();
        //10.
        $disease= new App\Desease;
        $desease->nombre('Mal de Charcot');
        $desease->observaciones('Hereditario');
        $desease->save();
        //11.
        $disease= new App\Desease;
        $desease->nombre('Fiebre amarilla');
        $desease->observaciones('Transmitida por un mosquito, muy común en África');
        $desease->save();
        //12.
        $disease= new App\Desease;
        $desease->nombre('Fiebre Tifoidea');
        $desease->observaciones('Fibre elevada y síntomas abdominales');
        $desease->save();
        //13.
        $disease= new App\Desease;
        $desease->nombre('VPH');
        $desease->observaciones('La ETS más común');
        $desease->save();
        //14.Colitis
        $disease= new App\Desease;
        $desease->nombre('Colitis');
        $desase->observaciones('Puede ser causada por estrés');

    }
}
