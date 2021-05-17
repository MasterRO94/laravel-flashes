<?php

namespace MasterRO\Flash;

use Session;

class Flash
{
    public string $message;

    public string $type;

    public bool $session;

    /**
     * Flash constructor.
     *
     * @param string $message
     * @param string $type
     * @param bool $session
     */
    public function __construct(string $message = '', string $type = 'success', bool $session = true)
    {
        $this->message = $message;
        $this->type = $type;
        $this->session = $session;
    }

    public static function make(string $message = '', string $type = 'success', bool $session = true): Flash
    {
        return new static($message, $type, $session);
    }

    public function success(string $message, bool $session = true)
    {
        return static::make($message, 'success', $session)->push();
    }

    public function warning(string $message, bool $session = true)
    {
        return static::make($message, 'warning', $session)->push();
    }

    public function info(string $message, bool $session = true)
    {
        return static::make($message, 'info', $session)->push();
    }

    public function error(string $message, bool $session = true)
    {
        return static::make($message, 'error', $session)->push();
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
