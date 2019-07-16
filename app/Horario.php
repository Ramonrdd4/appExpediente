<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public function Agenda()
    {
        return $this->hasMany('App\Agenda');
    }
}
