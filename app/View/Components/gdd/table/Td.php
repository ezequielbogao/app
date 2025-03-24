<?php

namespace App\View\Components\Gdd\table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Td extends Component
{
	public $text;

	public function __construct($text)
	{
		$this->text = $text;
	}

	public function render(): View|Closure|string
	{
		return view('gdd.components.table.td');
	}
}
