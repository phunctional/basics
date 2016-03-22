<?php

namespace Phunctional;

class Composition
{
    private $f;
    private function __construct(callable $f)
    {
        $this->f = $f;
    }

    public static function startWith(callable $f)
    {
        return new self($f);
    }

    public function compose(callable $g)
    {
        return new self(function (...$args) use ($g) {
            return call_user_func($this->f, call_user_func_array($g, $args));
        });
    }

    public function andThen(callable $g)
    {
        return self::startWith($g)->compose($this->f);
    }

    public function __invoke(...$args)
    {
        return call_user_func_array($this->f, $args);
    }
}
