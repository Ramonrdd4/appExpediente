<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compartir extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }
}
