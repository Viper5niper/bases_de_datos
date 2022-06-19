<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasajero extends Model
{
    // use HasFactory;
    protected $table = 'pasajeros';

    protected $fillable = [
        'nombre',
        'apellido',
        'genero',
        'ubicacion_id',
        'fecha_nacimiento',
    ];

    public function boletos()
    {
        return $this->hasMany('App\Models\Boleto');
    }

    public function ubicacion()
    {
        return $this->belongsTo('App\Models\Ubicacion');
    }

}
