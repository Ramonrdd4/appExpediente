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
            'id'=> 116850044
        ]);
    }
}
