<?php

namespace MasterRO\Flash;

use Illuminate\Support\Facades\Facade;

class FlashFacade extends Facade
{
	/**
	 * @return string
	 */
	public static function getFacadeAccessor()
	{
		return Flash::class;
	}
}
