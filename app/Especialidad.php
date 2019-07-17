<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    public $table='especialidades';
    public function servicio_Consulta()
    {
        return $this->hasmany('App\Servicio_Consulta');
    }
}
