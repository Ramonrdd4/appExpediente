<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    public function Horario()
    {
        return $this->belongsTo('App\Horario');
    }

    public function Profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
