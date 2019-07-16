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
            'nombre'        => 'administrador',
            'descripcion' => 'administrador',
        ]);

        $publicador= \App\Role::create([
            'nombre'        => 'Medico',
            'descripcion' => 'Doctor',
        ]);
        $cliente = \App\Role::create([
           'nombre'        => 'Paciente',
           'descripcion' => 'Cliente',
       ]);
       
    }
}
