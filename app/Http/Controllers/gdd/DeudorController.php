<?php

namespace App\Http\Controllers\Gdd;

use App\Http\Controllers\Controller;
use App\Models\Gdd\Gestion;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DeudorController extends Controller
{
    use ApiResponse;

    public function dashboard()
    {
        return view('gdd.dashboard');
    }

    public function index()
    {
        return view('gdd.deudores');
    }

    public function getData()
    {
        $deudores = DB::connection('dwh')
            ->table('Rafam_Comercios')
            ->where('NRO_COMERCIO', '<', 15000)
            ->get(['NRO_COMERCIO', 'NOMBRE', 'RUBRO', 'CUIT']);

        return $this->apiResponse(true, $deudores);
    }
}
