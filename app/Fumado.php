<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fumado extends Model
{
    public function expediente()
    {
        return $this->hasOne('App\Expediente', 'id', 'id');
    }
}
