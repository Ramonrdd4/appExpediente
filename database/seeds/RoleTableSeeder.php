<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = \App\Role::create([
            'name'        => 'administrador',
            'description' => 'administrador',
        ]);

        $publicador= \App\Role::create([
            'name'        => 'Medico',
            'description' => 'Doctor',
        ]);
        $cliente = \App\Role::create([
           'name'        => 'Paciente',
           'description' => 'Cliente',
       ]);
    }
}
