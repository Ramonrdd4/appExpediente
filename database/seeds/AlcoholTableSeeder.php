<?php

use Illuminate\Database\Seeder;

class AlcoholTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alcohol= App\Alcohol::create([
            'id'=>116850044,
            'estadoAlcohol'=> 1,
            'tiempoInicio' => 'mas de 1 año',
            'frecuencia' => 2,
            'tipoLicor' => 'Vino',
            'cantidad'=> 350,
            'Observaciones' => 'Solo casillero del diablo y frontera chile, cosecha de 1980 para atrás.'
        ]);
        $alcohol->save();

        $alcohol= App\Alcohol::create([
            'id'=>116850045,
            'estadoAlcohol'=> 2,
            'tiempoInicio' => 'mas de 3 año',
            'frecuencia' => 4,
            'tipoLicor' => 'Licor',
            'cantidad'=> 250,
            'Observaciones' => 'Amaba el vodka, dejo hace 3 meses.'
        ]);
        $alcohol->save();

        $alcohol= App\Alcohol::create([
            'id'=>116850046,
            'estadoAlcohol'=> 3,
            'tiempoInicio' => 'N/A',
            'frecuencia' => 0,
            'tipoLicor' => 'N/A',
            'cantidad'=> 0,
            'Observaciones' => 'Detesta el alcohol.'
        ]);
        $alcohol->save();
    }
}
