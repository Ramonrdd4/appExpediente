<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function expedientes()
    {
        return $this->hasMany('App\Expedientes');
    }
}
