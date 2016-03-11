<?php

namespace Phunctional\Option;

use Phunctional\Option;

class None implements Option
{
    public function map(callable $f): Option
    {
        return $this;
    }

    public function flatMap(callable $f): Option
    {
        return $this;
    }

    public function isEmpty(): bool
    {
        return true;
    }

    public function get()
    {
        throw new EmptyOptionException;
    }

    public function getOrElse($value)
    {
        return $value;
    }
}
