<?php

namespace Phunctional\Tests;

use Phunctional\Functor;

abstract class FunctorLawsTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Dataprovider for testIdentity()
     * Returns an array with one or more arrays in it.
     * Every entry contains a Functor instance
     *
     * Like:
     * [
     *   [
     *     'functor' => new MyFunctor()
     *   ]
     * ]
     *
     * @return array
     */
    abstract public function provideFunctors();

    /**
     * @dataProvider provideFunctors
     */
    public function testIdentity(Functor $functor)
    {
        $identity = function ($x) { return $x; };
        $this->assertEquals($functor, $functor->map($identity));
    }

    /**
     * Dataprovider for testComposition()
     * Returns an array with one or more arrays in it.
     * Every entry contains a Functor instance and two functions which operate on the value(s) within the Functor
     *
     * Like:
     * [
     *   [
     *     'functor' => new MyFunctor(1, 2, 3),
     *     'square' => function (int $i): int { return $i * $i; },
     *     'double' => function (int $i): int { return $i * 2; },
     *   ]
     * ]
     *
     * @return array
     */
    abstract public function provideCasesProvingComposition();

    /**
     * @dataProvider provideCasesProvingComposition
     */
    public function testComposition(Functor $functor, callable $f, callable $g)
    {
        $fThenG = function ($x) use ($f, $g) { return $g($f($x)); };
        $this->assertEquals($functor->map($fThenG), $functor->map($f)->map($g));
    }
}
