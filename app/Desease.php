<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desease extends Model
{
    public function expedientes()
    {
        return $this->hasMany('App\Expedientes');
    }
}
