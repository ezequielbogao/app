<?php

namespace App\Http\Controllers\Gdd;

use App\Http\Controllers\Controller;
use App\Models\Gdd\CuentaCorriente;
use App\Models\Gdd\Gestion;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DeudorController extends Controller
{
    use ApiResponse;

    private $viewFolder = 'gdd.pages.';

    public function dashboard()
    {
        return view($this->viewFolder . 'dashboard');
    }

    public function index()
    {
        return view($this->viewFolder . 'deudores');
    }

    public function getData(Request $request)
    {
        $startTime = microtime(true);

        // Parámetros de DataTables
        $start = $request->input('start', 0);
        $length = $request->input('length', 10); // Limitamos a 50 por página
        $search = $request->input('search.value', '');
        $orderColumnIndex = $request->input('order.0.column', 0);
        $orderDirection = $request->input('order.0.dir', 'asc');
        $draw = $request->input('draw', 1);

        // Columnas disponibles
        $columns = [
            'RECURSO',
            'IMPONIBLE',
            'ANIO',
            'CUOTA',
            'MONTO_TOTAL_ORIGEN',
            'MONTO_TOTAL_INTERES',
            'MONTO_TOTAL_DLNYF',
            'MONTO_TOTAL',
            'FECHA_VTO',
            'SITUACION',
            'NRO_PLAN',
            'ID_GESTION'
        ];

        $query = DB::table('RAFAM_CC')->select($columns);

        $totalRecords = DB::table('RAFAM_CC')->count();

        if ($search !== '' && $search !== null) {
            $query->where(function ($q) use ($search) {
                $q->where('RECURSO', 'like', "%{$search}%")
                    ->orWhere('IMPONIBLE', 'like', "%{$search}%");
            });
        }

        $recordsFiltered = $search ? $query->clone()->count() : $totalRecords;

        $orderColumn = $columns[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDirection);

        // Paginación
        $deudores = $query->offset($start)
            ->limit($length)
            ->get();

        $executionTime = microtime(true) - $startTime;
        Log::info("Tiempo: {$executionTime}s, Registros: {$deudores->count()}, Search: '$search'");

        // Respuesta para DataTables
        return response()->json([
            'draw' => (int)$draw,
            'recordsTotal' => (int)$totalRecords,
            'recordsFiltered' => (int)$recordsFiltered,
            'data' => $deudores->values()->toArray()
        ]);
    }
}
