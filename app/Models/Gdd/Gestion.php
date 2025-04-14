<?php

namespace App\Models\Gdd;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    protected $table = 'GDD';

    public $timestamps = false;

    protected $fillable = [
        'ID_GESTION',
        'RECURSO',
        'IMPONIBLE',
        'PERIODOS_ADEUDADOS',
        'DEUDA_TOTAL',
        'INICIO_GESTION',
        'FINALIZACION_GESTION',
        'ESTADO_GESTION',
        'OBSERVACION',
        'FECHA_DE_PAGO',
        'FORMA_DE_PAGO',
        'PP_VINCULADO'
    ];

    public function scopeByEstado($query, $estado)
    {
        return $query->where('ESTADO_GESTION', $estado);
    }

    public function scopeByNroImponible($query, $nroImponible)
    {
        return $query->where('IMPONIBLE', $nroImponible);
    }
}
