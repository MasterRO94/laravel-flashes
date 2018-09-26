<?php

namespace MasterRO\Flash;

use Session;

class Flash
{
	/**
	 * @var string
	 */
	public $message;

	/**
	 * @var string
	 */
	public $type;

	/**
	 * @var bool
	 */
	public $session;

	/**
	 * Flash constructor.
	 *
	 * @param $message
	 * @param string $type
	 * @param bool $session
	 */
	public function __construct($message = '', $type = 'success', $session = true)
	{
		$this->message = $message;
		$this->type = $type;
		$this->session = $session;
	}

	/**
	 * Success
	 *
	 * @param string $message
	 * @param bool $session
	 *
	 * @return mixed
	 */
	public static function success($message, $session = true)
	{
		return ((new static($message, 'success', $session))->push());
	}

	/**
	 * Warning
	 *
	 * @param string $message
	 * @param bool $session
	 *
	 * @return mixed
	 */
	public static function warning($message, $session = true)
	{
		return ((new static($message, 'warning', $session))->push());
	}

	/**
	 * Info
	 *
	 * @param string $message
	 * @param bool $session
	 *
	 * @return mixed
	 */
	public static function info($message, $session = true)
	{
		return ((new static($message, 'info', $session))->push());
	}

	/**
	 * Error
	 *
	 * @param string $message
	 * @param bool $session
	 *
	 * @return mixed
	 */
	public static function error($message, $session = true)
	{
		return ((new static($message, 'error', $session))->push());
	}

	/**
	 * Push this Flash Message to Session
	 *
	 * @return mixed
	 */
	public function push()
	{
		$type = $this->type;
		$message = $this->message;

		if ($this->session) {
			return Session::push('flash_messages', compact('type', 'message'));
		}

		return Session::flash('flash_messages', [compact('type', 'message')]);
	}
}
