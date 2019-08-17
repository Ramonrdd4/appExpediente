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
        $alergia->ruta_imagen ='Fabiola_alergia_1566069131.jpg';
        $alergia->save();
        //2.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a los hongos';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Neumonitis por hipersensibilidad.';
        $alergia->observaciones='Posible caso de origen laboral.';
        $alergia->ruta_imagen ='Fabiola_alergia_1566069149.jpg';
        $alergia->save();
        //3.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a los acaros';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Picazón de garganta y/u oídos.';
        $alergia->observaciones='Exposición a lugares llenos de polvo.';
        $alergia->ruta_imagen ='Fabiola_alergia_1566069158.jpg';
        $alergia->save();
        //4.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a himenópteros';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Inflamación, dolor y comezon en el lugar de la picadura.';
        $alergia->observaciones='Incluye abejas, avispas y hormigas rojas.';
        $alergia->ruta_imagen = 'Fabiola_alergia_1566069171.jpg';
        $alergia->save();
        //5.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia al huevo';
        $alergia->categoria='Alimentos';
        $alergia->reaccion='Picor en la boca y garganta';
        $alergia->observaciones='Se produce al poco tiempo de la ingesta';
        $alergia->ruta_imagen = 'Fabiola_alergia_1566069179.jpg';
        $alergia->save();
        //6.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a los mariscos';
        $alergia->categoria='Alimentos';
        $alergia->reaccion='Rinitis alergica, asma o dificultad para respirar.';
        $alergia->observaciones='Mascotas con pelo como perros y gatos o de plumas como aves.';
        $alergia->ruta_imagen = 'Fabiola_alergia_1566069211.jpg';
        $alergia->save();
        //7.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a mascotas';
        $alergia->categoria='Ambiente';
        $alergia->reaccion='Rinitis alergica, asma o dificultad para respirar.';
        $alergia->observaciones='Mascotas con pelo como perros y gatos o de plumas como aves.';
        $alergia->ruta_imagen = 'Fabiola_alergia_1566069217.jpg';
        $alergia->save();

        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a la leche';
        $alergia->categoria='Alimentos';
        $alergia->reaccion='Enrojecimiento de la piel, edemas en los labios y/o párpados';
        $alergia->observaciones='Es hereditaria';
        $alergia->ruta_imagen = 'Fabiola_alergia_1566069234.jpg';
        $alergia->save();
        //11.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a las frutas';
        $alergia->categoria='Alimentos';
        $alergia->reaccion='Hinchazon de labios y lengua';
        $alergia->observaciones='Provocada por frutas rosaceas como las freas y melocotones';
        $alergia->ruta_imagen = 'Fabiola_alergia_1566069240.jpg';
        $alergia->save();
        //11.
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a la amoxicilina';
        $alergia->categoria='Medicamentos';
        $alergia->reaccion='Mareas y pulso alterado';
        $alergia->observaciones='Aperece entre 12 y 24 horas despues de ingerir el medicamento';
        $alergia->ruta_imagen = 'Fabiola_alergia_1566069171.jpg';
        $alergia->save();
        //12
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia a la aspirina';
        $alergia->categoria='Medicamentos';
        $alergia->reaccion='Anemia y falta de aire';
        $alergia->observaciones='Ocurre días después.';
        $alergia->ruta_imagen = 'Fabiola_alergia_1566069259.jpg';
        $alergia->save();
        //13
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia al metotrexato';
        $alergia->categoria='Medicamentos';
        $alergia->reaccion='Nefritis(Inflamación de los riñones';
        $alergia->observaciones='Presenta sangre en la orina';
        $alergia->ruta_imagen = 'Fabiola_alergia_1566069275.png';
        $alergia->save();
        //14
        $alergia = new \App\Alergia();
        $alergia->nombre='Alergia al abraxane';
        $alergia->categoria='Medicamentos';
        $alergia->reaccion='Dolor e hinchazon en las articulaciones';
        $alergia->observaciones='Meicamento utilizado en quimioterapia para el cancer de mama.';
        $alergia->ruta_imagen = 'Fabiola_alergia_1566069286.jpg';
        $alergia->save();
        //15.
        $alergia = new \App\Alergia();
        $alergia->nombre='Otro';
        $alergia->categoria='N/R';
        $alergia->reaccion='N/R';
        $alergia->observaciones='N/R';
        $alergia->ruta_imagen ='Fabiola_alergia_1566069304.jpg';
        $alergia->save();
    }
}
