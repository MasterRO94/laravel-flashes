<?php

namespace MasterRO\Flash;

use Session;

class Flash
{
    public string $message;

    public string $type;

    public bool $storeInMainSession;

    protected array $data;

    /**
     * Flash constructor.
     *
     * @param string $message
     * @param string $type
     * @param bool $storeInMainSession
     */
    public function __construct(
        string $message = '',
        string $type = 'success',
        bool $storeInMainSession = true,
        array $data = []
    ) {
        $this->message = $message;
        $this->type = $type;
        $this->storeInMainSession = $storeInMainSession;
        $this->data = $data;
    }

    public static function make(
        string $message = '',
        string $type = 'success',
        bool $storeInMainSession = true,
        array $data = []
    ): Flash {
        return new static($message, $type, $storeInMainSession, $data);
    }

    public function with(array $data): Flash
    {
        $this->data = $data;

        return $this;
    }

    public function fill(
        ?string $message = null,
        ?string $type = null,
        ?bool $storeInMainSession = null,
        ?array $data = null
    ): Flash {
        if (null !== $message) {
            $this->message = $message;
        }

        if (null !== $type) {
            $this->type = $type;
        }

        if (null !== $storeInMainSession) {
            $this->storeInMainSession = $storeInMainSession;
        }

        if (null !== $data) {
            $this->data = $data;
        }

        return $this;
    }

    public function success(string $message, ?bool $storeInMainSession = null, ?array $data = null)
    {
        return $this->fill($message, 'success', $storeInMainSession, $data)->push();
    }

    public function warning(string $message, ?bool $storeInMainSession = null, ?array $data = null)
    {
        return $this->fill($message, 'warning', $storeInMainSession, $data)->push();
    }

    public function info(string $message, ?bool $storeInMainSession = null, ?array $data = null)
    {
        return $this->fill($message, 'info', $storeInMainSession, $data)->push();
    }

    public function error(string $message, ?bool $storeInMainSession = null, ?array $data = null)
    {
        return $this->fill($message, 'error', $storeInMainSession, $data)->push();
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
        $data = $this->data;

        if ($this->storeInMainSession) {
            return Session::push('flash_messages', compact('type', 'message', 'data'));
        }

        return Session::flash('flash_messages', [compact('type', 'message', 'data')]);
    }

    public function __call($method, $arguments = [])
    {
        $this->fill($arguments[0], $method)->push();
    }
}
