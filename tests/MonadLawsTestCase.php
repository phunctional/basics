<?php

namespace Phunctional\Tests;

use Phunctional\Monad;

abstract class MonadLawsTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Dataprovider for testLeftIdentity()
     * Returns an array with one or more arrays in it.
     * Every entry contains three items: a value, the same value in a monad,
     * and a function that takes the same type of value and returns the same type of Monad
     *
     * Like:
     * [
     *   [
     *     'value' => 1,
     *     'monad' => new MyMonad(1)
     *     'operand' => function (int $i): Monad { return new MyMonad($i * 2); }
     *   ]
     * ]
     *
     * @return array
     */
    abstract public function provideCasesProvingLeftIdentity();

    /**
     * @dataProvider provideCasesProvingLeftIdentity
     */
    public function testLeftIdentity($value, Monad $monad, callable $f)
    {
        $this->assertEquals($monad->flatMap($f), $f($value));
    }

    /**
     * Dataprovider for testRightIdentity()
     * Returns an array with one or more arrays in it.
     * Every entry contains two items: a monadic value and a function
     * that takes the same type of value and injects it in the same type of Monad untouched
     *
     * Like:
     * [
     *   [
     *     'monad' => new MyMonad(1)
     *     'operand' => function (int $i): Monad { return new MyMonad($i); }
     *   ]
     * ]
     *
     * @return array
     */
    abstract public function provideCasesProvingRightIdentity();

    /**
     * @dataProvider provideCasesProvingRightIdentity
     */
    public function testRightIdentity(Monad $monad, callable $f)
    {
        $this->assertEquals($monad->flatMap($f), $monad);
    }

    /**
     * Dataprovider for testAssociativity()
     * Returns an array with one or more arrays in it.
     * Every entry contains three items: a monadic value and two functions
     * that take the same type of value and returns the same type of Monad
     *
     * Like:
     * [
     *   [
     *     'monad' => new MyMonad(1)
     *     'f' => function (int $i): Monad { return new MyMonad($i * 2); },
     *     'g' => function (int $i): Monad { return new MyMonad($i * $i); }
     *   ]
     * ]
     *
     * @return array
     */
    abstract public function provideCasesProvingAssociativity();

    /**
     * @dataProvider provideCasesProvingAssociativity
     */
    public function testAssociativity(Monad $monad, callable $f, callable $g)
    {
        $nested = function ($i) use ($f, $g) { return $f($i)->flatMap($g); };
        $this->assertEquals($monad->flatMap($f)->flatMap($g), $monad->flatMap($nested));
    }
}
