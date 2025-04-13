<?php

namespace App\Http\Controllers\Gdd;

use App\Http\Controllers\Controller;
use App\Models\Gdd\Gestion;
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
		$r  = request();

		$validator = Validator::make($r->all(), [
			'selected'   => 'required|array',
		], [
			'selected.required' => 'Debes seleccionar al menos un deudor',
		]);

		if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

		$deudores = $this->formatearImponibles($r->selected);

		foreach ($deudores as $deudor) {
			$recurso 		= $deudor[0];
			$nro_imponible 	= $deudor[1];
			$periodos 		= $deudor[2];
			$monto_total 	= $deudor[3];
			Gestion::create([
				'RECURSO'       => $recurso,
				'NRO_IMPONIBLE' => $nro_imponible,
				'PERIODOS'      => $periodos,
				'MONTO_TOTAL'   => $monto_total,
				'INICIO'        => now()->format('d-m-Y'),
				// 'FINALIZACION'  => '',
				'ESTADO'        => 'Vigente',
				'OBSERVACION'   => '-',
			]);
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
