<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fumado extends Model
{
    public $incrementing = false;
    public function expediente()
    {
        return $this->hasOne('App\Expediente', 'idfumado');
    }
}
