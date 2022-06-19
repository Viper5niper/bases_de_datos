<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avion extends Model
{
    // use HasFactory;
    protected $table = 'aviones';

    // make fillable fields for the model 
    protected $fillable = [
        'aerolinea_id',
        'modelo',
        'fabricante',
        'capacidad',
    ];

    public function vuelos()
    {
        return $this->hasMany('App\Models\Vuelo');
    }

    public function aerolineas()
    {
        return $this->belongsTo('App\Models\Aerolinea');
    }
}
