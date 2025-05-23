<?php

namespace App\View\Components\Gdd\Icons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Deudor extends Component
{
	public $w;
	public $h;

	public function __construct($w = '25', $h = '25')
	{
		$this->w = $w;
		$this->h = $h;
	}

	public function render(): View|Closure|string
	{
		return view('gdd.components.icons.deudor');
	}
}
