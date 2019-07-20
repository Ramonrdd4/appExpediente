<?php

use Illuminate\Database\Seeder;

class ExpedienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expediente= App\Expediente::create([
            'idperfil'=> 116850044,
            'idfumado'=>116850044,
            'idalcoholismo'=>116850044

        ]);
        $expediente->save();
    }
}
