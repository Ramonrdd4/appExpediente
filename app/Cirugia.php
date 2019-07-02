<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cirugia extends Model
{
    public function expediente()
    {
        return $this->belongsTo('App\Expediente', 'idExpediente', 'id');
    }
}
