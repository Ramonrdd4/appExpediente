<?php

use Illuminate\Database\Seeder;

class AlergiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Alergias de categoria ambiente.
        //1.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia al polen';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Lagrimeo, picor, enrojecimiento oculuar y conjuntivitis';
        $alergia->observaciones='Respuesta del sistema inmunologico al polen.';
        $alergia->listaId=1;
        $alergia->save();
        //2.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a los hongos';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Neumonitis por hipersensibilidad.';
        $alergia->observaciones='Posible caso de origen laboral.';
        $alergia->listaId=1;
        $alergia->save();
        //3.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a los acaros';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Picazón de garganta y/u oídos.';
        $alergia->observaciones='Exposición a lugares llenos de polvo.';
        $alergia->listaId=1;
        $alergia->save();
        //4.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a himenópteros';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Inflamación, dolor y comezon en el lugar de la picadura.';
        $alergia->observaciones='Incluye abejas, avispas y hormigas rojas.';
        $alergia->listaId=1;
        $alergia->save();
        //5.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia al huevo';
        $alergia->categoria='Alimentos';
        $alergia->reaccion='Picor en la boca y garganta';
        $alergia->observaciones='Se produce al poco tiempo de la ingesta';
        $alergia->listaId=1;
        $alergia->save();
        //6.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a los mariscos';
        $alergia->categoria='Alimentos';
        $alergia->reaccion='Rinitis alergica, asma o dificultad para respirar.';
        $alergia->observaciones='Mascotas con pelo como perros y gatos o de plumas como aves.';
        $alergia->listaId=1;
        $alergia->save();
        //7.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a mascotas';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Rinitis alergica, asma o dificultad para respirar.';
        $alergia->observaciones='Mascotas con pelo como perros y gatos o de plumas como aves.';
        $alergia->listaId=1;
        $alergia->save();
        //8.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a mascotas';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Rinitis alergica, asma o dificultad para respirar.';
        $alergia->observaciones='Mascotas con pelo como perros y gatos o de plumas como aves.';
        $alergia->listaId=1;
        $alergia->save();
        //9.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a mascotas';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Enrojeciemiento de los ojos y dificultad para respirar';
        $alergia->observaciones='El olor tambien desencadena las reacciones.';
        $alergia->listaId=1;
        $alergia->save();
        //10.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a la leche';
        $alergia->categoria='Alimentos';
        $alergia->reaccion='Enrojecimiento de la piel, edemas en los labios y/o párpados';
        $alergia->observaciones='Es hereditaria';
        $alergia->listaId=1;
        $alergia->save();
        //11.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a las frutas';
        $alergia->categoria='Alimentos';
        $alergia->reaccion='Hinchazon de labios y lengua';
        $alergia->observaciones='Provocada por frutas rosaceas como las freas y melocotones';
        $alergia->save();
        //11.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a la amoxicilina';
        $alergia->categoria='Medicamentos';
        $alergia->reaccion='Mareas y pulso alterado';
        $alergia->observaciones='Aperece entre 12 y 24 horas despues de ingerir el medicamento';
        $alergia->save();
        //12
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a la aspirina';
        $alergia->categoria='Medicamentos';
        $alergia->reaccion='Anemia y falta de aire';
        $alergia->observaciones='Ocurre días después.';
        $alergia->save();
        //13
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia al metotrexato';
        $alergia->categoria='Medicamentos';
        $alergia->reaccion='Nefritis(Inflamación de los riñones';
        $alergia->observaciones='Presenta sangre en la orina';
        $alergia->save();
        //14
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia al abraxane';
        $alergia->categoria='Medicamentos';
        $alergia->reaccion='Dolor e hinchazon en las articulaciones';
        $alergia->observaciones='Meicamento utilizado en quimioterapia para el cancer de mama.';
        $alergia->save();
    }
}
