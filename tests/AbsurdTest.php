<?php

namespace ContinuousUnitTest;

use PHPUnit\Framework\TestCase;

class AbsurdTest extends TestCase
{
    public function testTrueIsTrue()
    {
        $foo = true;
        $this->assertTrue($foo);
    }

    public function testFalseIsFalse()
    {
        $foo = false;
        $this->assertFalse($foo);
    }
}