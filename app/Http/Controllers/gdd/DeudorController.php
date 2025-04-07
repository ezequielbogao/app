<?php

namespace App\Http\Controllers\Gdd;

use App\Http\Controllers\Controller;
use App\Models\Gdd\Gestion;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function getData()
    {
        $deudores = DB::table('RAFAM_CC')
            // ->take(50) // Limitar la cantidad de resultados
            ->get([
                'RECURSO',
                'IMPONIBLE',
                'ANIO',
                'CUOTA',
                'MONTO_TOTAL_ORIGEN',
                'MONTO_TOTAL_INTERES',
                'MONTO_TOTAL_DLNYF',
                'MONTO_TOTAL_DLNYF', // Nota: hay un campo repetido
                'MONTO_TOTAL',
                'FECHA_VTO',
                'SITUACION',
                'NRO_PLAN',
                'ID_GESTION'
            ])->toArray();


        return $this->apiResponse(true, $deudores);
    }

    // public function getData(Request $request)
    // {
    //     // Obtener los parámetros enviados por DataTables
    //     $start = $request->input('start', 0);       // Índice de la primera fila
    //     $length = $request->input('length', 10);     // Número de filas por página
    //     $search = $request->input('search.value', '');  // Valor de búsqueda
    //     $orderColumnIndex = $request->input('order.0.column', 0); // Índice de la columna por la que se ordena
    //     $orderDirection = $request->input('order.0.dir', 'asc'); // Dirección del orden

    //     // Definir las columnas para ordenar
    //     $columns = [
    //         'RECURSO',
    //         'IMPONIBLE',
    //         'ANIO',
    //         'CUOTA',
    //         'MONTO_TOTAL_ORIGEN',
    //         'MONTO_TOTAL_INTERES',
    //         'MONTO_TOTAL_DLNYF',
    //         'MONTO_TOTAL',
    //         'FECHA_VTO',
    //         'SITUACION',
    //         'NRO_PLAN',
    //         'ID_GESTION'
    //     ];

    //     // Crear la consulta base
    //     $query = DB::table('RAFAM_CC');

    //     // Si hay un término de búsqueda, aplicarlo
    //     if ($search) {
    //         $query->where('RECURSO', 'like', '%' . $search . '%')
    //             ->orWhere('IMPONIBLE', 'like', '%' . $search . '%')
    //             ->orWhere('ANIO', 'like', '%' . $search . '%')
    //             ->orWhere('CUOTA', 'like', '%' . $search . '%');
    //     }

    //     // Ordenar según la columna y dirección recibidas
    //     $query->orderBy($columns[$orderColumnIndex], $orderDirection);

    //     // Obtener el total de registros sin aplicar filtros
    //     $totalRecords = DB::table('RAFAM_CC')->count();

    //     // Obtener los datos con paginación
    //     $deudores = $query->skip($start)          // Saltar las filas de la página anterior
    //         ->take($length)         // Tomar el número de registros por página
    //         ->get([
    //             'RECURSO',
    //             'IMPONIBLE',
    //             'ANIO',
    //             'CUOTA',
    //             'MONTO_TOTAL_ORIGEN',
    //             'MONTO_TOTAL_INTERES',
    //             'MONTO_TOTAL_DLNYF',
    //             'MONTO_TOTAL',
    //             'FECHA_VTO',
    //             'SITUACION',
    //             'NRO_PLAN',
    //             'ID_GESTION'
    //         ]);

    //     // Devolver los datos en el formato que espera DataTables
    //     return response()->json([
    //         'draw' => $request->input('draw'),
    //         'recordsTotal' => $totalRecords,
    //         'recordsFiltered' => $deudores->count(),
    //         'data' => $deudores
    //     ]);
    // }
}
