<?php

use Illuminate\Database\Seeder;

class ParentezcoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parentezco= App\Parentezco::create([

            'descripcion'=>'mama del paciete',
            'familiar'=>'madre'
        ]);
        $parentezco->save();
        $parentezco= App\Parentezco::create([

            'descripcion'=>'padre del paciete',
            'familiar'=>'padre'
        ]);
        $parentezco->save();
        $parentezco= App\Parentezco::create([

            'descripcion'=>'hermano del paciete',
            'familiar'=>'hermano'
        ]);
        $parentezco->save();
    }
}
