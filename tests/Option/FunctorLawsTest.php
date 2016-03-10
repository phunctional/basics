<?php

namespace Phunctional\Tests\Option;

use Phunctional\Option;
use Phunctional\Option\{Some, None};
use Phunctional\Tests\FunctorLawsTestCase;

class FunctorLawsTest extends FunctorLawsTestCase
{
    public function provideFunctors()
    {
        return [
            [new Some(10)],
            [new None()],
        ];
    }

    public function provideCasesProvingComposition()
    {
        $square = function (int $i): int { return $i * $i; };
        $double = function (int $i): int { return $i * 2; };

        return [
            [
                'functor' => new Some(1),
                'square' => $square,
                'double' => $double,
            ],
            [
                'functor' => new None(),
                'square' => $square,
                'double' => $double,
            ],
        ];
    }
}
