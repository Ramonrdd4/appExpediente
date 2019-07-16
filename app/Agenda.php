<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    public function Horario()
    {
        return $this->hasmany('App\Horario');
    }

    public function user()
    {
        return $this->hasmany('App\User');
    }
}
