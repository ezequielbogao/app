<?php

namespace App\Http\Controllers\gdd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeudorController extends Controller
{
    public function dashboard()
    {
        return view('gdd.dashboard');
    }

    public function deudores()
    {
        return view('gdd.deudores');
    }

    public function gestion()
    {
        return view('gdd.gestion');
    }
}
