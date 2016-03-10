<?php

namespace Phunctional\Tests\Option;

use Phunctional\Monad;
use Phunctional\Option;
use Phunctional\Option\{Some, None};
use Phunctional\Tests\MonadLawsTestCase;

class MonadLawsTest extends MonadLawsTestCase
{
    public function provideCasesProvingLeftIdentity()
    {
        return [
            [
                'value' => 1,
                'monad' => new Some(1),
                'operand' => function(int $i): Monad { return new Some($i * 2); }
            ]
        ];
    }

    public function provideCasesProvingRightIdentity()
    {
        return [
            'Some obeys right identity' => [
                'monad' => new Some(1),
                'operand' => function (int $i): Monad { return new Some($i); }
            ],
            'None obeys right identity' => [
                'monad' => new None,
                'operand' => function (): Monad { return new None; }
            ]
        ];
    }

    public function provideCasesProvingAssociativity()
    {
        $f = function (int $i): Option { return new Some($i * 2); };
        $g = function (int $i): Option { return new Some($i * $i); };

        return [
            'Some is associative' => [
                'monad' => new Some(1),
                'f' => $f,
                'g' => $g,
            ],
            'None is associative' => [
                'monad' => new None,
                'f' => $f,
                'g' => $g,
            ],
        ];
    }
}
