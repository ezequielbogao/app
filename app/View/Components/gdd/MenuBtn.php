<?php

namespace App\View\Components\gdd;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuBtn extends Component
{
	public $to;
	public $icon;
	public $label;
	public $titulo;
	public $contador;

	public function __construct($to = null, $icon = null, $label = null, $titulo = null, $contador = null)
	{
		$this->to = $to;
		$this->icon = $icon;
		$this->label = $label;
		$this->titulo = $titulo;
		$this->contador = $contador;
	}

	public function render(): View|Closure|string
	{
		return view('gdd.components.menuBtn');
	}
}
