<?php

use Illuminate\Database\Seeder;

class ListaDeseaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lista = App\listaDesease::create();
        $lista->save();
    }
}
