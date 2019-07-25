<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fumado extends Model
{
    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }
}
