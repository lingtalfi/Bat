<?php

use Ling\Bat\ValidationTool;
use Ling\PhpBeast\AuthorTestAggregator;
use Ling\PhpBeast\PrettyTestInterpreter;
use Ling\PhpBeast\Tool\ComparisonErrorTableTool;


require_once "bigbang.php";


$agg = AuthorTestAggregator::create();

$a = [
    'maurice@gmail.com',
    'cromagnon.fr',
    'cromagnon@fr',
    '-@-.-',
];

$b = [
    true,
    false,
    false,
    false,
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg, $testNumber) {
    
    $res = ValidationTool::isEmail($value);
    if ($expected !== $res) {
        ComparisonErrorTableTool::collect($testNumber, $expected, $res);
    }
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);
ComparisonErrorTableTool::display();