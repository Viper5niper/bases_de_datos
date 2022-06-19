<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class OrdenTrabajo extends Model
{
    use HasFactory;

    //protected $table = "orden_trabajos";

    protected $fillable = [
        'vin_vehiculo',
        'placa_vehiculo',
        'propietario_vehiculo',
        'marca_vehiculo',
        'modelo_vehiculo',
        'anio_vehiculo',
        'kilometraje_vehiculo',   //en caso de que se ingresen millas, se convierten a km y se almacenan
        'unidad_vehiculo',        //"Mi" o "Km"
        'cliente_id',
        'tecnico_encargado',      //nombre de la persona encargada del servicio
        'descripcion_servicio',   //descripcion completa del servicio brindado
        'detalle_servicio',       //detalle en formato json de los costos del servicio completo
        'monto_servicio',         //coste total del servicio
        'cancelado_servicio',     //monto cancelado por el cliente
        'pagado',                 //booleano para indicar si el servicio ya fue cancelado
        'observacion_servicio',   //observaciones realizadas al momento de brindar el servicio
        'trabajo_realizado',      //observaciones realizadas al momento de brindar el servicio
        'fecha_entrada',          //fecha en la que ingreso el vehiculo al taller
        'fecha_salida',           //fecha en la que se entrego el vehiculo al cliente
        'proximo_servicio',       //fecha a la cual se debera llamar al cliente para un proximo servicio (puede saltarse)
        'contactado',             //booleano para indicarle al encargado de taller cuales clientes ya fueron contactados
        'cotizacion'              //booleano para indicar si esta orden de trabajo es solo una cotizacion a ser utilizada mas adelante
    ];

    protected $casts = [
        'detalle_servicio' => 'array',
        'fecha_entrada' => 'datetime',
        'fecha_salida' => 'datetime',
        'proximo_servicio' => 'datetime',
    ];

    protected $with = ['cliente'];
    
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'ordentrabajo_id');
    }
    
    public function saveQuietly(array $options = [])
    {
        return static::withoutEvents(function () use ($options) {
            return $this->save($options);
        });
    }

    protected static function booted()
    {
        
        // static::created(function ($ordenestrabajo) {
        //     $ordenestrabajo->recalcMontoCancelado();
        // });
        
        static::updated(function ($ordenestrabajo) {
            //dd($ordenestrabajo->cancelado_servicio > $ordenestrabajo->monto_servicio);
            if($ordenestrabajo->cancelado_servicio > $ordenestrabajo->monto_servicio){
                $ordenestrabajo->pagos()->delete();
                $ordenestrabajo->recalcMontoCancelado();    //esta linea vuelve a hacer trigger de update
            }else if($ordenestrabajo->cancelado_servicio < $ordenestrabajo->monto_servicio && $ordenestrabajo->pagado){
                $ordenestrabajo->pagado = 0;
                $ordenestrabajo->saveQuietly();
            }else if($ordenestrabajo->cancelado_servicio == $ordenestrabajo->monto_servicio){
                $ordenestrabajo->pagado = 1;
                $ordenestrabajo->saveQuietly();
            }
        });

        static::deleted(function ($ordenestrabajo) {
            // list all filenames in given path
            $paths = $ordenestrabajo->getOrdenTrabajoFilesPaths();
            foreach ($paths as $path) {
                Storage::delete($path);
            }

            $ordenestrabajo->pagos()->delete();
        });
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function getOrdenTrabajoFilesPaths()
    {
        $allFiles = Storage::files('public/ordenestrabajo/');
        // filter the ones that match the filename.* 
        $matchingFiles = preg_grep('/' . $this->id . $this->marca_vehiculo . $this->modelo_vehiculo . '_' . '/', $allFiles);

        // iterate through files and echo their content
        $paths = array();
        foreach ($matchingFiles as $path) {
            array_push($paths, $path);
        }
        return $paths;
    }

    public function getOrdenTrabajoFilesNames()
    {
        $allFiles = Storage::files('public/ordenestrabajo/');
        // filter the ones that match the filename.* 
        $matchingFiles = preg_grep('/' . $this->id . $this->marca_vehiculo . $this->modelo_vehiculo . '_' . '/', $allFiles);

        // iterate through files and echo their content
        $names = array();
        foreach ($matchingFiles as $path) {
            array_push($names, basename($path));
        }
        return $names;
    }

    public function recalcMontoCancelado()
    {
        // $pagos = $this->pagos();
        // $sum = 0;
        // foreach($pagos as $pago){
        //     $sum += $pago->monto_cancelado;
        // }
        $this->cancelado_servicio = $this->pagos()->sum('monto');
        $this->cancelado_servicio < $this->monto_servicio ? $this->pagado = false : $this->pagado = true;
        $this->saveQuietly();
    }
}

/*
EJemplo de objeto json de "detalle_servicio"

[
    {
        "descripcion" : "filtro de aire",
        "origen" : "tercero",    //este item fue adquirido a una empresa ajena
        "costo" : 150
    },
    {
        "descripcion" : "aceite de transmision",
        "origen" : "propio",    //este item fue brindado por nuestra empresa
        "costo" : 150
    },
    {
        "descripcion" : "cambio de aceite",
        "origen" : "manodeobra",    //este item fue brindado por el personal de la empresa
        "costo" : 150
    },
]

*/