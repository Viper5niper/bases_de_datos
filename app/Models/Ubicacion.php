<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    // use HasFactory;
    protected $table = 'ubicaciones';

    protected $fillable = [
        'pais',
        'ciudad',
        'latitud',
        'longitud',
    ];

    public function vuelosorigen()
    {
        return $this->hasMany('App\Models\Vuelo','origen_id');
    }

    public function vuelosdestino()
    {
        return $this->hasMany('App\Models\Avion','destino_id');
    }
}
