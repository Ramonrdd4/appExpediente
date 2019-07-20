<?php

use Illuminate\Database\Seeder;

class ListaAlergiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lista = App\listaAlergia::create();
        $lista->save();
    }
}
