<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aerolinea extends Model
{
    // use HasFactory;
    protected $table = 'aerolineas';

    protected $fillable = [
        'nombre',
    ];

    public function aviones()
    {
        return $this->hasMany('App\Models\Avion');
    }
}
