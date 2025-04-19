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
}
