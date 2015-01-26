<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 23/01/15
 * Time: 20:56
 */

namespace Calculator;


class Addition implements iOperator{


    function run($number, $current)
    {
        return $number + $current;
    }


}