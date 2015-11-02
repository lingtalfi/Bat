<?php

use Bat\StringTool;
use PhpBeast\AuthorTestAggregator;
use PhpBeast\PrettyTestInterpreter;

require_once "bigbang.php";




//------------------------------------------------------------------------------/
// EXHAUSTING TEST DEMO
//------------------------------------------------------------------------------/
$agg = AuthorTestAggregator::create();

$a = [
    'hello68',
    'hello',
    'hello-78.79',
    '123',
];

$b = [
    ['hello', 68],
    ['hello', false],
    ['hello-78.', 79],
    ['', 123],
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg) {
    $res = StringTool::cutNumericalSuffix($value);
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);