<?php

namespace App\View\Components\Gdd\table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tr extends Component
{
	public $content;

	public function __construct($content)
	{
		$this->content = $content;
	}

	public function render(): View|Closure|string
	{
		return view('gdd.components.table.tr');
	}
}
