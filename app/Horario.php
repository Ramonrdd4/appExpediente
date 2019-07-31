<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = ['Fecha_cita','hora_cita'];
    public function Agenda()
    {
        return $this->hasMany('App\Agenda');
    }
    public function servicio_consulta()
    {
        return $this->belongsTo('App\Servicio_Consulta','id_servicioConsulta','id');
    }
}
