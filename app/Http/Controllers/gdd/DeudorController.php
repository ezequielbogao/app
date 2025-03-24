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
        // $deudores = DB::connection('dwh')
        //     ->table('Rafam_Comercios')
        //     ->where('NRO_COMERCIO', '<', 15000)
        //     ->get(['NRO_COMERCIO', 'NOMBRE', 'RUBRO', 'CUIT']);


        $deudores = [
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1001,
                "CUOTA" => 1,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 25417.67,
                "FECHA_VTO" => "15/03/25",
                "SITUACION" => "notificada",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1001,
                "CUOTA" => 2,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 18030.22,
                "FECHA_VTO" => "22/04/25",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1002,
                "CUOTA" => 1,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 15985.3,
                "FECHA_VTO" => "05/02/25",
                "SITUACION" => "notificada",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1002,
                "CUOTA" => 2,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 28900.45,
                "FECHA_VTO" => "10/03/25",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1003,
                "CUOTA" => 3,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 27892.55,
                "FECHA_VTO" => "13/03/25",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 999,
                "CUOTA" => 2,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 27959.437,
                "FECHA_VTO" => "25/04/15",
                "SITUACION" => "notificada",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1000,
                "CUOTA" => 3,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 19833.242,
                "FECHA_VTO" => "25/05/22",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1000,
                "CUOTA" => 2,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 17583.83,
                "FECHA_VTO" => "25/03/05",
                "SITUACION" => "notificada",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1003,
                "CUOTA" => 3,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 31790.495,
                "FECHA_VTO" => "25/04/10",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1002,
                "CUOTA" => 4,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 30681.805,
                "FECHA_VTO" => "25/04/13",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1003,
                "CUOTA" => 2,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 27959.437,
                "FECHA_VTO" => "25/04/15",
                "SITUACION" => "notificada",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1002,
                "CUOTA" => 3,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 19833.242,
                "FECHA_VTO" => "25/05/22",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1001,
                "CUOTA" => 2,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 17583.83,
                "FECHA_VTO" => "25/03/05",
                "SITUACION" => "notificada",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1002,
                "CUOTA" => 3,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 31790.495,
                "FECHA_VTO" => "25/04/10",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1002,
                "CUOTA" => 4,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 30681.805,
                "FECHA_VTO" => "25/04/13",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1001,
                "CUOTA" => 3,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 30755.3807,
                "FECHA_VTO" => "15/05/25",
                "SITUACION" => "notificada",
                "ESTADO" => "sin pagos",
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 998,
                "CUOTA" => 4,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 21816.5662,
                "FECHA_VTO" => "22/06/25",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos"
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1000,
                "CUOTA" => 3,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 19342.213,
                "FECHA_VTO" => "05/04/25",
                "SITUACION" => "notificada",
                "ESTADO" => "sin pagos"
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1001,
                "CUOTA" => 4,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 34969.5445,
                "FECHA_VTO" => "10/05/25",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos"
            ],
            [
                "RECURSO" => "TSM",
                "NRO_IMPONIBLE" => 1001,
                "CUOTA" => 5,
                "ANIO" => 2025,
                "MONTO_TOTAL" => 33749.9855,
                "FECHA_VTO" => "13/05/25",
                "SITUACION" => "vigente",
                "ESTADO" => "sin pagos"
            ]
        ];

        return $this->apiResponse(true, $deudores);
    }
}
