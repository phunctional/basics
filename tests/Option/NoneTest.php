<?php

namespace Phunctional\Tests\Option;

use Phunctional\Option\None;

class NoneTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEmpty()
    {
        $this->assertTrue((new None())->isEmpty());
    }
    /**
     * @expectedException \Phunctional\Option\EmptyOptionException
     */
    public function testGetThrows()
    {
        (new None())->get();
    }

    public function testGetOrElse()
    {
        $this->assertSame(1, (new None)->getOrElse(1));
    }

    public function testMapReturnsSelf()
    {
        $none = new None();
        $this->assertSame($none, $none->map(function () {}));
    }

    public function testFlatMapReturnsSelf()
    {
        $none = new None();
        $this->assertSame($none, $none->flatMap(function () {}));
    }
}
