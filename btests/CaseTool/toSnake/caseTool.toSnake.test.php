<?php

use Bat\CaseTool;
use PhpBeast\AuthorTestAggregator;
use PhpBeast\PrettyTestInterpreter;
use PhpBeast\Tool\ComparisonErrorTableTool;

require_once "bigbang.php";


$agg = AuthorTestAggregator::create();

$a = [ 
    '',
    'ok', 
    'OK',
    ' OK ',
    'I get it a_a_A',
    'really  ?  ?  ?',
    'really___?__?__?',
    'bête',
];

$b = [
    '',
    'ok',
    'ok',
    '_ok_',
    'i_get_it_a_a_a',
    'really_',
    'really_',
    'bete',
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg, $testNumber) {

    $res = CaseTool::toSnake($value);
    if ($expected !== $res) {
        ComparisonErrorTableTool::collect($testNumber, $expected, $res);
    }
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);
ComparisonErrorTableTool::display();