<?php

if (! function_exists('flash')) {

	/**
	 * @param string $message
	 * @param string $type
	 * @param bool $session
	 */
	function flash($message = null, $type = 'success', $session = true)
	{
		(new \MasterRO\Flash\Flash($message, $type, $session))->push();
	}
}
