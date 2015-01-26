<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 23/01/15
 * Time: 15:49
 */

namespace Calculator;


use Prophecy\Exception\InvalidArgumentException;

class CalculatorStart
{
    /**
     * @var int
     */
    protected $result = 0;

    /**
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param ...$numbers
     */
    public function add(...$numbers)
    {
        $this->calculate($numbers, '+');
    }

    public function subtract(...$numbers)
    {
        $this->calculate($numbers, '-');
    }

    /**
     * @param $numbers
     * @param $symbol
     */
    protected function calculate($numbers, $symbol)
    {
        foreach ($numbers as $number) {
            $this->calcul($number, $symbol);
        }
    }

    /**
     * @param array string
     */
    protected function calcul($number, $symbol)
    {

        if (!is_numeric($number)) {
            throw new \InvalidArgumentException(sprintf('this (%s) is not a number ', $number));
        }

        switch ($symbol) {
            case '+':
                $this->result += $number;
                break;
            case '-':
                ($this->result==0)? $this->result=$number : $this->result-=$number;
        }
    }

    /**
     *
     */
    public function reset()
    {
        $this->result = 0;
    }
}