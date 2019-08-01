<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alcohol extends Model
{
    protected $fillable = ['id','estadoAlcohol', 'tiempoInicio','frecuencia','tipoLicor','cantidad','Observaciones'];
    public $incrementing = false;
    public function expediente()
    {
        return $this->hasOne('App\Expediente', 'idalcoholismo');
    }
}
