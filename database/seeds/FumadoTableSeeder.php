<?php

use Illuminate\Database\Seeder;

class FumadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fumado= App\Fumado::create([
            'id'=>116850044,
            'estadoFumado'=>3,
            'tiempoInicio'=>'N/A',
            'frecuencia'=>0,
            'observaciones'=>'Utiliza vaporizador'
        ]);
        $fumado->save();

        $fumado= App\Fumado::create([
            'id'=>116850045,
            'estadoFumado'=>1,
            'tiempoInicio'=>'Mas de 3 años',
            'frecuencia'=>7,
            'observaciones'=>'Tambien consume Canabis'
        ]);
        $fumado->save();

        $fumado= App\Fumado::create([
            'id'=>116850046,
            'estadoFumado'=>2,
            'tiempoInicio'=>'Mas de 5 años',
            'frecuencia'=>15,
            'observaciones'=>'Se detuvo hace 1 año'
        ]);
        $fumado->save();
    }
}
