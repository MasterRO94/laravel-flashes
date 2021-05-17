<?php

if (! function_exists('flash')) {
	function flash(string $message = null, string $type = 'success', bool $session = true)
	{
	    if (!$message) {
	        return \MasterRO\Flash\Flash::make();
        }

	    return \MasterRO\Flash\Flash::make($message, $type, $session)->push();
	}
}
