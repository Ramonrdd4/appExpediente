<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alcohol extends Model
{
    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }
}
