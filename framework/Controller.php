<?php

namespace Phine;

use Philo\Blade\Blade;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	protected $blade;

	public function __construct(Blade $blade)
	{
		$this->blade = $blade;
	}

	public function view($name, $vars)
	{
		return $this->blade->view()->make($name)->with($vars)->render();
	}
}
