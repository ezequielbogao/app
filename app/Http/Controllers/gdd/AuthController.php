<?php

namespace App\Http\Controllers\Gdd;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
	use ApiResponse;

	private $viewFolder = 'gdd.pages.';

	public function login()
	{
		return view($this->viewFolder . 'auth.login');
	}
}
