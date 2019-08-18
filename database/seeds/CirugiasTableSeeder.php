<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CirugiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cirugia = App\Cirugia::create([
            'fecha' => Carbon::create('2001', '02', '01'),
            'lugar' => 'Vesícula',
            'idExpediente' => 116850045
        ]);
        $cirugia->save();

        $cirugia = App\Cirugia::create([
            'fecha' => Carbon::create('2004', '06', '21'),
            'lugar' => 'Clavícula',
            'idExpediente' => 116850046
        ]);
        $cirugia->save();

        $cirugia = App\Cirugia::create([
            'fecha' => Carbon::create('2007', '06', '28'),
            'lugar' => 'Riñon izquierdo',
            'idExpediente' => 116850044
        ]);
        $cirugia->save();

        $cirugia = App\Cirugia::create([
            'fecha' => Carbon::create('2002', '03', '25'),
            'lugar' => 'Rodilla Derecha',
            'idExpediente' => 116850044
        ]);
        $cirugia->save();
    }
}
