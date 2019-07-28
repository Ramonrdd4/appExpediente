<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cirugia extends Model
{
    protected $fillable = ['fecha', 'lugar', 'idExpediente'];
    public function expediente()
    {
        return $this->belongsTo('App\Expediente', 'idExpediente', 'id');
    }
}
