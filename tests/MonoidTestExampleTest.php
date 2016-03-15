<?php

namespace Phunctional\Tests;

use Phunctional\Monoid;

class MonoidTestExampleTest extends MonoidLawsTestCase
{
    public function provideCasesProvingIdentity()
    {
        return [
            [
                'monoid' => new AdditionMonoid(),
                'value' => 30
            ]
        ];
    }

    public function provideCasesProvingAssociativity()
    {
        return [
            [
                'monoid' => new AdditionMonoid(),
                'a' => 10,
                'b' => 15,
                'c' => 20
            ]
        ];
    }
}

class AdditionMonoid implements Monoid
{
    public function identityElement(): int
    {
        return 0;
    }

    public function operation(): callable
    {
        return function (int $a, int $b): int { return $a + $b; };
    }
}
