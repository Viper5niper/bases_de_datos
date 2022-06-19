<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    // use HasFactory;
    protected $table = 'boletos';

    protected $fillable = [
        'pasajero_id',
        'vuelo_id',
        'llegada',  // fecha y hora a la que llega el pasajero. Se usa para ver cuales estan atrasados en llegar
    ];

    public function pasajero()
    {
        return $this->belongsTo('App\Models\Pasajero');
    }

    public function vuelo()
    {
        return $this->belongsTo('App\Models\Vuelo');
    }


}
