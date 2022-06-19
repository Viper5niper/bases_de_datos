<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    // use HasFactory;
    protected $table = 'vuelos';

    protected $fillable = [
        'origen_id',
        'destino_id',
        'avion_id',
        'despegue',
        'aterrizaje',
        'precio',
        'recorrido',
    ];

    
    public function origen()
    {
        return $this->belongsTo('App\Models\Origen');
    }
    
    public function destino()
    {
        return $this->belongsTo('App\Models\Destino');
    }
    
    public function avion()
    {
        return $this->belongsTo('App\Models\Avion');
    }
}
