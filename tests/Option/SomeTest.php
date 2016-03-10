<?php

namespace Phunctional\Tests\Option;

use Phunctional\Option\Some;

class SomeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEmpty()
    {
        $this->assertFalse((new Some("string"))->isEmpty());
    }

    public function testGet()
    {
        $this->assertSame(1, (new Some(1))->get());
        $this->assertSame(1, (new Some(1))->getOrElse(2));
    }

    public function testMap()
    {
        $addOne = function ($i) { return $i + 1; };
        $this->assertEquals(new Some(2), (new Some(1))->map($addOne));
    }

    public function testFlatMap()
    {
        $multiplyByTwo = function ($i) { return new Some($i*2); };
        $this->assertEquals(new Some(2), (new Some(1))->flatMap($multiplyByTwo));
    }
}
