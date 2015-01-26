<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 23/01/15
 * Time: 21:22
 */

namespace Calculator;


class Multiplication implements iOperator
{
    function run($num, $current)
    {
        return ((is_null($current))? $num : ($current==0)? $num*1 : $num*$current);
    }

}