<?php

namespace Phunctional\Option;

use Phunctional\Option;

class Some implements Option
{
    private $value;
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function map(callable $f): Option
    {
        return new self($f($this->value));
    }

    public function flatMap(callable $f): Option
    {
        return $f($this->value);
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function get()
    {
        return $this->value;
    }

    public function getOrElse($value)
    {
        return $this->value;
    }
}
