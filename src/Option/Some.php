<?php

namespace Phunctional\Option;

use Phunctional\Functor;
use Phunctional\Monad;
use Phunctional\Option;

class Some implements Option
{
    private $value;
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function map(callable $f): Functor
    {
        return new self($f($this->value));
    }

    public function flatMap(callable $f): Monad
    {
        return $f($this->value);
    }

    /**
     * @return boolean
     */
    public function isEmpty(): bool
    {
        return false;
    }

    /**
     * @return mixed $value of type T
     * @throws EmptyOptionException
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * @param mixed $value of type T
     * @return $value of type T
     */
    public function getOrElse($value)
    {
        return $this->value;
    }
}
