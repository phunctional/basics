<?php

namespace Phunctional;

interface Functor/*[T]*/
{
    /**
     * @param callable $f T => U
     *
     * @return Functor[U]
     */
    public function map(callable $f): Functor;
}
