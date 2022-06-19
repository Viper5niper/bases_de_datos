<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//Cada vez que se modifique uno de los pagos de una orden de trabajo, se debera volver a sumar todos los pagos de dicha orden de trabajo para modificar el campo monto_cancelado

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordentrabajo_id', 
        'monto',
        'metodo',
    ];

    protected $with = ['ordentrabajo'];

    public function ordentrabajo(){
        return $this->belongsTo(OrdenTrabajo::class,'ordentrabajo_id');
    }

    protected static function booted()
    {
        static::created(function ($pago) {
            $ot = OrdenTrabajo::find($pago->ordentrabajo_id);
            $ot->recalcMontoCancelado();
        });

        static::updated(function ($pago) {
            $ot = OrdenTrabajo::find($pago->ordentrabajo_id);
            $ot->recalcMontoCancelado();
        });

        static::deleted(function ($pago) {
            $ot = OrdenTrabajo::find($pago->ordentrabajo_id);
            $ot->recalcMontoCancelado();
        });
    }

}
