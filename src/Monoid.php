<?php

namespace Phunctional;

interface Monoid/*[T]*/
{
    /**
     * @return mixed $value of type T
     */
    public function identityElement();

    /**
     * @return callable (T, T) => T
     */
    public function operation(): callable;
}
