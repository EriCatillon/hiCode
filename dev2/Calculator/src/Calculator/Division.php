<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 23/01/15
 * Time: 21:26
 */

namespace Calculator;


use Prophecy\Exception\InvalidArgumentException;

class DivisionBy implements iOperator{

    function run($num, $current)
    {
        if($current ==0 )
        {
            throw new InvalidArgumentException(" it's impossible division by zero");
        }

        return (is_null($current))? $num : rand($num/$current);
    }

}