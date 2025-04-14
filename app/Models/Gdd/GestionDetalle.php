<?php

namespace App\Models\Gdd;

use Illuminate\Database\Eloquent\Model;

class GestionDetalle extends Model
{
	public $timestamps = false;

	protected $table = 'GDD_DETALLE';
	protected $primaryKey = 'ID_GESTION';

	protected $fillable = [
		'ID_GESTION',
		'FECHA',
		'ACCION',
		'CONTACTO',
		'RESULTADO',
		'RESPUESTA',
		'EMPLEADO'
	];
}
