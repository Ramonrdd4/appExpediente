<?php

use Illuminate\Database\Seeder;
use App\Medicamento;

class MedicamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='paracetamol';
        $medicamento->descripcion='Alivia la fiebre';
        $medicamento->save();
        //2.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Suero';
        $medicamento->descripcion='Efectivo contra la deshidratación';
        $medicamento->save();
        //3.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='enterogermina';
        $medicamento->descripcion='Enzimas para la flora intestinal, alivia la diarrea';
        $medicamento->save();
        //4.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Tenofovir alafenamida(TAF)';
        $medicamento->descripcion='Tratamiento para la hepatitis B';
        $medicamento->save();
        //5.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Isoniazida(INH)';
        $medicamento->descripcion='Combate la tuberculosis';
        $medicamento->save();
        //6.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Etambutol';
        $medicamento->descripcion='Combate la tuberculosis';
        $medicamento->save();
        //7.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Buscapina';
        $medicamento->descripcion='Alivia la colitis';
        $medicamento->save();
        //8.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Secretagogos';
        $medicamento->descripcion='Píldoras liberadoras de insulina';
        $medicamento->save();
        //9.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Diuréticos';
        $medicamento->descripcion='Actua sobre los riñones para eliminar sodio y el agua, ayuda a la hipertensión';
        $medicamento->save();
        //10.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Analgésicos';
        $medicamento->descripcion='Reducen el dolor';
        $medicamento->save();
        //11.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Medicamentos antiinflamatorios no esteroides (AINE)';
        $medicamento->descripcion='Efectivos contra la artritis';
        $medicamento->save();
        //12.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Cortisona';
        $medicamento->descripcion='Reduce inflamación e inhibe el sistema inmunitario. Efectivo contra la artritis.';
        $medicamento->save();
        //13.
        $medicamento = new App\Medicamento;
        $medicamento->nombre='Amoxicilina';
        $medicamento->descripcion='Antibiótico, familia de la penicilina';
        $medicamento->save();

    }
}
