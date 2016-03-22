<?php

namespace Phunctional\Tests;

use Phunctional\Composition;

class CompositionTest extends \PHPUnit_Framework_TestCase
{
    public function testComposition()
    {
        $value = 5;
        $f = function (int $x): int { return $x * 2; };
        $g = function (int $x): int { return $x + 2; };

        $f_compose_g = Composition::startWith($f)->compose($g);
        $f_andThen_g = Composition::startWith($f)->andThen($g);

        $this->assertEquals((5 + 2) * 2, $f_compose_g($value));
        $this->assertEquals($f($g($value)), $f_compose_g($value));

        $this->assertEquals((5 * 2) + 2, $f_andThen_g($value));
        $this->assertEquals($g($f($value)), $f_andThen_g($value));
    }

    public function testChainedComposition()
    {
        $value = 5;
        $f = function (int $x): int { return $x * 2; };
        $g = function (int $x): int { return $x + 2; };
        $h = function (int $x): int { return $x ** 2; };

        $composed = Composition::startWith($f)->compose($g)->compose($h)->andThen($h);

        $this->assertEquals($h($f($g($h($value)))), $composed($value));
    }

    public function testMultipleArgs()
    {
        $f = function (int $x, int $y): int { return $x + $y; };
        $g = function (int $x): int { return $x * 2; };

        $f_andThen_g = Composition::startWith($f)->andThen($g);
        $g_compose_f = Composition::startWith($g)->compose($f);

        $this->assertEquals($g($f(1, 2)), $f_andThen_g(1, 2));
        $this->assertEquals($g($f(1, 2)), $g_compose_f(1, 2));
    }

    public function testImmutability()
    {
        $f = function (string $str): string { return "hello $str"; };
        $g = function (string $str): string { return "$str!"; };

        $f_compose_g = Composition::startWith($f)->compose($g);
        $upper = $f_compose_g->andThen("strtoupper");

        $this->assertEquals("hello world!", $f_compose_g("world"));
        $this->assertEquals("HELLO WORLD!", $upper("world"));
    }

    public function testVariousCallables()
    {
        $square = function (int $x): int { return $x ** 2; };

        $composed = Composition::startWith($square)
            ->compose([$this, "double"])
            ->compose([self::class, "addTwo"])
            ->compose(new SubtractThree())
            ->andThen("sqrt");

        $subtractThree = new SubtractThree();
        $value = 5;
        $this->assertEquals(
            sqrt(
                $square(
                    $this->double(
                        self::addTwo(
                            $subtractThree($value)
                        )
                    )
                )
            ),
            $composed($value)
        );
        $this->assertEquals(sqrt(((($value -3) +2) *2) **2), $composed($value));
    }

    public function double(int $x): int
    {
        return $x * 2;
    }

    public static function addTwo(int $x): int
    {
        return $x + 2;
    }
}

class SubtractThree
{
    public function __invoke(int $x): int
    {
        return $x - 3;
    }
}
