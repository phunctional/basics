<?php

namespace Phunctional\Tests;

use Phunctional\Monoid;

abstract class MonoidLawsTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Dataprovider for testIdentity()
     * Returns an array with one or more arrays in it.
     * Every entry contains two items: a Monoid instance, and a value which it can operate on
     *
     * Like:
     * [
     *   [
     *     'monoid' => new MyMonoid(),
     *     'value' => 41
     *   ]
     * ]
     *
     * @return array
     */
    abstract public function provideCasesProvingIdentity();

    /**
     * @dataProvider provideCasesProvingIdentity
     */
    public function testIdentity(Monoid $monoid, $value)
    {
        $operation = $monoid->operation();
        $this->assertEquals($value, $operation($monoid->identityElement(), $value));
    }

    /**
     * Dataprovider for testIdentity()
     * Returns an array with one or more arrays in it.
     * Every entry contains four items: a Monoid instance, and three values which it can operate on
     *
     * Like:
     * [
     *   [
     *     'monoid' => new AdditionMonoid(),
     *     'a' => 1,
     *     'b' => 2,
     *     'c' => 3
     *   ]
     * ]
     *
     * @return array
     */
    abstract public function provideCasesProvingAssociativity();

    /**
     * @dataProvider provideCasesProvingAssociativity
     */
    public function testAssociativity(Monoid $monoid, $a, $b, $c)
    {
        $operation = $monoid->operation();
        $this->assertEquals($operation($a, $operation($b, $c)), $operation($operation($a, $b), $c));
    }
}
