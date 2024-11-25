<?php

use MasterRO\Flash\Flash;

if (! function_exists('flash')) {
	function flash(?string $message = null, string $type = 'success', bool $session = true)
	{
	    if (!$message) {
	        return Flash::make();
        }

	    return Flash::make($message, $type, $session)->push();
	}
}
