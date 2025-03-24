<?php

namespace App\View\Components\Gdd\table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Th extends Component
{
	public $text;
	public $sm;

	public function __construct($text, $sm = null)
	{
		$this->text = $text;
		$this->sm = $sm;
	}

	public function render(): View|Closure|string
	{
		return view('gdd.components.table.th');
	}
}
