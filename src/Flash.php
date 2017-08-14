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
	 * @param $message
	 * @param bool $session
	 */
	public static function success($message, $session = true)
	{
		((new static($message, 'success', $session))->push());
	}


	/**
	 * @param $message
	 * @param bool $session
	 */
	public static function warning($message, $session = true)
	{
		((new static($message, 'warning', $session))->push());
	}


	/**
	 * @param $message
	 * @param bool $session
	 */
	public static function info($message, $session = true)
	{
		((new static($message, 'info', $session))->push());
	}


	/**
	 * @param $message
	 * @param bool $session
	 */
	public static function error($message, $session = true)
	{
		((new static($message, 'error', $session))->push());
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

		if ($this->session) return Session::push('flash_messages', compact('type', 'message'));

		return Session::flash('flash_messages', [compact('type', 'message')]);
	}

}