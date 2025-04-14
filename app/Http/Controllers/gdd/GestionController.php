<?php

namespace App\Http\Controllers\Gdd;

use App\Http\Controllers\Controller;
use App\Models\Gdd\Gestion;
use App\Models\Gdd\GestionDetalle;
use App\Models\Gdd\GestionEstado;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GestionController extends Controller
{
	use ApiResponse;

	private $viewFolder = 'gdd.pages.';

	public function index()
	{
		$gestiones = Gestion::all();
		return view($this->viewFolder . 'gestion.index', ['resource' => $gestiones]);
	}

	public function create(Request $r)
	{
		try {
			$r  = request();
			$validator = Validator::make($r->all(), [
				'selected'   => 'required|array',
			], [
				'selected.required' => 'Debes seleccionar al menos un deudor',
			]);

			if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

			$deudores = $this->formatearImponibles($r->selected);

			foreach ($deudores as $deudor) {
				$RECURSO 			= $deudor[0];
				$IMPONIBLE 			= $deudor[1];
				$PERIODOS_ADEUDADOS	= $deudor[2];
				$DEUDA_TOTAL 		= $deudor[3];

				$gestion = Gestion::create([
					'RECURSO'               => $RECURSO,
					'IMPONIBLE'             => $IMPONIBLE,
					'PERIODOS_ADEUDADOS'    => $PERIODOS_ADEUDADOS,
					'DEUDA_TOTAL'           => $DEUDA_TOTAL,
					'INICIO_GESTION'        => now()->format('Y-m-d'),
					'ESTADO_GESTION'        => 'VIGENTE',
					'FORMA_DE_PAGO' 		=> 'PLAN DE PAG0',

				]);

				if (!$gestion) {
					throw new \Exception("No se pudo crear la gestión para imponible $IMPONIBLE");
				}

				$detalle = GestionDetalle::create([
					'ID_GESTION' 	=> $gestion->id,
					'FECHA' 		=> now()->format('Y-m-d'),
					'ACCION' 		=> 'NOTIFICACIÓN',
					'CONTACTO' 		=> '',
					'RESULTADO' 	=> 'EL CONTACTO NO CORRESPONDE',
					'RESPUESTA' 	=> '',
					'EMPLEADO' 		=> '',
				]);

				if (!$detalle) {
					throw new \Exception("No se pudo crear el detalle de gestión para imponible $IMPONIBLE");
				}
			}
		} catch (\Throwable $th) {

			throw $th;
		}


		return $this->apiResponse(true, null, 'Gestión creada con exito');
	}

	public function edit(Request $r)
	{
		$gestion = Gestion::where('id', $r->id)->first();

		if (!$gestion) return to_route('gdd.gestiones.index')->withErrors(['No se encontró la gestión']);
		return view($this->viewFolder . 'gestion.edit', ['resource' => $gestion]);
	}

	private function formatearImponibles(array $seleccionados)
	{
		$imponibles_agrupados = collect($seleccionados)->groupBy(function ($item) {
			return $item[1];
		});

		$deudores = $imponibles_agrupados->map(function ($group) {
			$grupo_imponible 	= $group[0];
			$recurso 			= $grupo_imponible[0]; // TSM
			$nro_mponible 		= $grupo_imponible[1]; // 1000

			$monto_total = collect($group)->sum(function ($item) {
				return (float)$item[4];
			});

			$cuota_anio = $group->sortBy(function ($item) {
				return $item[3]; // Ordena por CUOTA en orden ascendente
			})->map(function ($item) {
				return "{$item[3]}/{$item[2]}"; // "2/2025"
			})->implode(',');

			return [$recurso, $nro_mponible, $cuota_anio, $monto_total];
		})->values()->toArray();

		return $deudores;
	}
}
