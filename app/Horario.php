<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Horario extends Model
{
    use SoftDeletes;
       protected $fillable = [
        'Fecha_cita','hora_cita', 'id_servicioConsulta'];
    public function Agenda()
    {
        return $this->belongsTo('App\Agenda','id','id_Horario');
    }
    public function servicio__consultas()
    {
        return $this->belongsTo('App\servicio__consultas','id_servicioConsulta','id' );
    }
    protected $dates = ['deleted_at'];
}
