<?php

namespace Phunctional;

interface Monad/*[T]*/
{
    /**
     * @param callable $f T => Monad[U]
     *
     * @return Monad[U]
     */
    public function flatMap(callable $f);
}
