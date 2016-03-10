<?php

namespace Phunctional\Option;

use Phunctional\Functor;
use Phunctional\Monad;
use Phunctional\Option;

class None implements Option
{
    public function map(callable $f): Functor
    {
        return $this;
    }

    public function flatMap(callable $f): Monad
    {
        return $this;
    }

    /**
     * @return boolean
     */
    public function isEmpty(): bool
    {
        return true;
    }

    /**
     * @return mixed $value of type T
     * @throws EmptyOptionException
     */
    public function get()
    {
        throw new EmptyOptionException;
    }

    /**
     * @param mixed $value of type T
     * @return mixed $value of type T
     */
    public function getOrElse($value)
    {
        return $value;
    }
}
