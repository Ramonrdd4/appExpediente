<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    public function profile()
    {
        return $this->belongsTo('App\Profile', 'id', 'id');
    }

    public function fumado()
    {
        return $this->hasOne('App\Fumado', 'id', 'id');
    }

    public function alcohol()
    {
        return $this->hasOne('App\Alcohol', 'id', 'id');
    }
}
