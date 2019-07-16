<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentezco extends Model
{
    public function expedientes()
    {
        return $this->hasMany('App\Expedientes');
    }
}
