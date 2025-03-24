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

	public function index()
	{
		$gestiones = Gestion::all();

		return view('gdd.gestion', ['resource' => $gestiones]);
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

		$deudores = DB::connection('dwh')
			->table('Rafam_Comercios')
			->whereIn('NRO_COMERCIO', $r->selected)
			->get(['NRO_COMERCIO', 'NOMBRE', 'RUBRO', 'CUIT']);

		foreach ($deudores as $deudor) {
			Gestion::create([
				'RECURSO'       => 'TSM',
				'NRO_IMPONIBLE' => $deudor->NRO_COMERCIO,
				'PERIODOS'      => '7/2020,10/2020,11/2020',
				'MONTO_TOTAL'   => 16000,
				'INICIO'        => '09/03/2025',
				// 'FINALIZACION'  => '',
				'ESTADO'        => 'Vigente',
				'OBSERVACION'   => '-',
			]);
		}

		return $this->apiResponse(true, null, 'Gestión creada con exito');
	}
}
