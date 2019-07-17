<?php

use Illuminate\Database\Seeder;

class ListaActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lista = App\listaAcitivity::create();
        $lista->save();
    }
}
