<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alcohol extends Model
{
    public function expediente()
    {
        return $this->hasOne('App\Expediente', 'id', 'id');
    }
}
