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
    }
}
