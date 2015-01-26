<?php

use Calculator\CalculatorStart;

class CalculatorStartTest extends PHPUnit_Framework_TestCase
{

    protected $calculator;

    public function setUp()
    {
        $this->calculator = new CalculatorStart;
    }

    public function testCalculatorInit()
    {
        $this->assertSame(0, $this->calculator->getResult());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRequireNumberValue()
    {
//        $this->markTestIncomplete(
//            'This test has not been implemented yet.'
//        );
        $this->calculator->add('five');
    }

    /**
     * @test accepts multiples values, PHP 5.6 min
     */
    public function testAcceptsMultipleArgs()
    {
        $this->calculator->add(1,2,3,4,5,6,7);
        $this->assertEquals(28, $this->calculator->getResult());
    }

    /**
     * @test reset
     */
    public function testReset()
    {
        $this->calculator->add(1,2,3,4,5,6,7);

        $this->calculator->reset();

        $this->assertEquals(0, $this->calculator->getResult());
    }

    /**
     * @test subtract mulitples numbers
     */

    public function testSubtractNumberValue()
    {
        $this->calculator->subtract(10,1,3,7);
        $this->assertEquals(-1, $this->calculator->getResult());
    }

    /**
     * @test it's a same thing
     */

    public function testSomeThingWithToMethodAddOrSubtract()
    {
        $this->calculator->add(10,-7);
        $this->assertEquals(3, $this->calculator->getResult());

        $this->calculator->reset();

        $this->calculator->subtract(10,7);

        $this->assertEquals(3, $this->calculator->getResult());
    }

    /**
     * @test test message
     */

    public function testMatchMessageException()
    {
        $this->setExpectedException('this (five) is not a number ');
        $this->calculator->add('five');
    }
}