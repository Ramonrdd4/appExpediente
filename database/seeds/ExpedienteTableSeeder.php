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
            'id'=> 116850044,
            'tieneAlergia' => false,
            'tieneEnfermedadF' => false,
            'tieneActividad' => false,
            'idfumado'=>116850044,
            'idalcoholismo'=>116850044

        ]);
        $expediente->save();
        $expediente->alergias()->attach([1, 2, 4]);
        $expediente->deseases()->attach([2, 5, 3]);
        $expediente->medicamentos()->attach([4, 2, 7]);
        $expediente->activities()->attach(2,['minutos'=> 30, 'cantidad'=> 2]);
        $expediente->activities()->attach(3,['minutos' => 10, 'cantidad'=> 1]);
        $expediente->activities()->attach(4,['minutos' => 15, 'cantidad'=> 3]);

        $expediente= App\Expediente::create([
            'id'=> 116850045,
            'tieneAlergia' => false,
            'tieneEnfermedadF' => false,
            'tieneActividad' => false,
            'idfumado'=>116850045,
            'idalcoholismo'=>116850045

        ]);
        $expediente->save();
        $expediente->deseases()->attach([1, 7]);
        $expediente->medicamentos()->attach([1, 2]);

        $expediente= App\Expediente::create([
            'id'=> 116850046,
            'tieneAlergia' => false,
            'tieneEnfermedadF' => false,
            'tieneActividad' => false,
            'idfumado'=>116850046,
            'idalcoholismo'=>116850046

        ]);
        $expediente->save();
        $expediente->deseases()->attach([14, 6]);
        $expediente->medicamentos()->attach([7, 8]);
    }
}
