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
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079126.jpg';
        $desease->save();
        //2.
        $desease= new App\Desease();
        $desease->nombre='Chikunguya';
        $desease->observaciones='Alrededor de 1500 casos por año';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079173.jpg';
        $desease->save();
        //3.
        $desease= new App\Desease();
        $desease->nombre='Diarreas';
        $desease->observaciones='Producida por bacterias en los intestinos';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079215.jpg';
        $desease->save();
        //4.
        $desease= new App\Desease();
        $desease->nombre='Hepatitis';
        $desease->observaciones='Puede ser causada por infecciones o respuesta inmunitaria';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079273.jpg';
        $desease->save();
        //5.
        $desease= new App\Desease();
        $desease->nombre='Tuberculosis';
        $desease->observaciones='Puede presentar sudores nocturnos';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079313.jpg';
        $desease->save();
        //6.
        $desease= new App\Desease();
        $desease->nombre='Diabetes';
        $desease->observaciones='Presenta tambien muchas ganas de orinar';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079444.jpg';
        $desease->save();
        //7.
        $desease= new App\Desease();
        $desease->nombre='Hipertensión';
        $desease->observaciones='Presenta tambien obesidad';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079473.jpg';
        $desease->save();
        //8.
        $desease= new App\Desease();
        $desease->nombre='Artritis';
        $desease->observaciones='Afecta specialmente las rodillas';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079514.jpg';
        $desease->save();
        //9.
        $desease= new App\Desease();
        $desease->nombre='Cancer de mama';
        $desease->observaciones='Podria ser hereditario';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079563.jpg';
        $desease->save();
        //10.
        $desease= new App\Desease();
        $desease->nombre='Mal de Charcot';
        $desease->observaciones='Hereditario';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079585.jpg';
        $desease->save();
        //11.
        $desease= new App\Desease();
        $desease->nombre='Fiebre amarilla';
        $desease->observaciones='Transmitida por un mosquito, muy común en África';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079616.png';
         $desease->save();
        //12.
        $desease= new App\Desease();
        $desease->nombre='Fiebre Tifoidea';
        $desease->observaciones='Fibre elevada y síntomas abdominales';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079640.jpg';
        $desease->save();
        //13.
        $desease= new App\Desease();
        $desease->nombre='VPH';
        $desease->observaciones='La ETS más común';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079677.jpg';
        $desease->save();
        //14.Colitis
        $desease= new App\Desease();
        $desease->nombre='Colitis';
        $desease->observaciones='Puede ser causada por estrés';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079726.jpg';
        $desease->save();
        //15.
        $desease= new App\Desease();
        $desease->nombre='Otra';
        $desease->observaciones='N/R';
        $desease->ruta_imagen ='Fabiola_enfermedad_1566079739.jpg';
        $desease->save();
    }
}
