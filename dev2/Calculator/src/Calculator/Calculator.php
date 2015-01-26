<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 23/01/15
 * Time: 18:23
 */

namespace Calculator;


class Calculator
{

    protected $operands = [];
    protected $operation;
    protected $result = 0;

    /**
     * set operands multiple
     *
     * @param ...$operands
     */
    public function setOperands(...$operands)
    {
        $this->operands = $operands;
    }

    /**
     *  set a new operation
     *
     * @param iOperator $operation
     */
    public function setOperation(iOperator $operation)
    {
        $this->operation = $operation;
    }

    /**
     * return result arithmetic operation
     *
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     *
     * @return Null
     */
    public function calculate()
    {
        foreach ($this->operands as $num) {
            if (!is_numeric($num)) {
                throw new \InvalidArgumentException(sprintf('this (%s) is not a number ', $num));
            }

            $this->result = $this->operation->run($num, $this->result);
        }

    }
}