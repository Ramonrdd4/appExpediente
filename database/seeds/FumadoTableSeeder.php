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
    }
}
