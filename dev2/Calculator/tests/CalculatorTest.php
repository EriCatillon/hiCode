<?php

use Calculator\Calculator;
use Calculator\Addition;
use Calculator\Multiplication;

class CalculatorTest extends PHPUnit_Framework_TestCase
{

    protected $calculator;

    public function setUp()
    {
        $this->calculator = new Calculator;
    }

    /**
     * @test add number
     */
    public function testAddNumbers()
    {
        $this->calculator->setOperands(5, 6, 7, 8);
        $this->calculator->setOperation(new Addition);

        $this->calculator->calculate();

        $this->assertEquals(26, $this->calculator->getResult());
    }

    /**
     * @test add one value
     */
    public function testAddOneValue()
    {
        $this->calculator->setOperands(5);
        $this->calculator->setOperation(new Addition);

        $this->calculator->calculate();

        $this->assertEquals(5, $this->calculator->getResult());
    }

    /**
     *
     * @test a number must be a numeric value
     *
     * @expectedException InvalidArgumentException
     */
    public function testRequireNumberValue()
    {
        $this->calculator->setOperands('five');
        $this->calculator->setOperation(new Addition);

        $this->calculator->calculate();
    }

    /**
     * @test multiplication
     */
    public function testMultiplication()
    {
        $this->calculator->setOperands(5, 6, 7, 8);
        $this->calculator->setOperation(new Multiplication);

        $this->calculator->calculate();

        $this->assertEquals(1680, $this->calculator->getResult());
    }

    /**
     * @test multiplication a number by zero must ne equal zero
     */
    public function testMultiByZero()
    {
        $this->calculator->setOperands(5, 0);
        $this->calculator->setOperation(new Multiplication);

        $this->calculator->calculate();

        $this->assertEquals(0, $this->calculator->getResult());
    }

}