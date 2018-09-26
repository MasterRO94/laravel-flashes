<?php

namespace MasterRO\Flash;

class FlashFacade
{
	/**
	 * @return string
	 */
	public static function getFacadeAccessor()
	{
		return Flash::class;
	}
}
