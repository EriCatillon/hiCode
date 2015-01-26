<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 23/01/15
 * Time: 18:22
 */

namespace Calculator;


interface iOperator {

    function run($num, $current);
}