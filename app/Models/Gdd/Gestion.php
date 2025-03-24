<?php

namespace App\Models\Gdd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gestion extends Model
{
    use SoftDeletes;

    protected $table = 'gestion';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'RECURSO',
        'NRO_IMPONIBLE',
        'PERIODOS',
        'MONTO_TOTAL',
        'INICIO',
        'FINALIZACION',
        'ESTADO',
        'OBSERVACION',
    ];

    protected $dates = [
        'INICIO',
        'FINALIZACION',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $casts = [
        'NRO_IMPONIBLE' => 'integer',
        'MONTO_TOTAL'   => 'integer',
        'INICIO'        => 'date',
        'FINALIZACION'  => 'date',
        'PERIODOS'      => 'string',
        'OBSERVACION'   => 'string',
    ];

    # $pendientes = Gestion::byEstado('pendiente')->get();
    public function scopeByEstado($query, $estado)
    {
        return $query->where('ESTADO', $estado);
    }

    # $gestion = Gestion::byNroImponible(12345)->first();
    public function scopeByNroImponible($query, $nroImponible)
    {
        return $query->where('NRO_IMPONIBLE', $nroImponible);
    }
}
