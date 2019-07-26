<?php

use Illuminate\Database\Seeder;
use App\listaAcitivity;
use App\listaAlergia;
use App\listaDesease;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ProfileTableSeeder::class);
        $this->call(DiseasesTableSeeder::class);
        $this->call(AlergiasTableSeeder::class);
        $this->call(ActivitiesTableSeeder::class);
        $this->call(MedicamentosTableSeeder::class);
        $this->call(FumadoTableSeeder::class);
        $this->call(AlcoholTableSeeder::class);
        $this->call(ExpedienteTableSeeder::class);


    }
}
