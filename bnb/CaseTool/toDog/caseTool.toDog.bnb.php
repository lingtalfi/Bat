<?php

use Ling\Bat\CaseTool;
use Ling\PhpBeast\AuthorTestAggregator;
use Ling\PhpBeast\PrettyTestInterpreter;
use Ling\PhpBeast\Tool\ComparisonErrorTableTool;

require_once __DIR__ . "/../../../../../bigbang.php";


$agg = AuthorTestAggregator::create();

$a = [ 
    '',
    'ok', 
    'OK',
    ' OK ',
    'I get it a_a_A',
    'really  ?  ?  ?',
    'really___?__?__?',
    'métisse',
];

$b = [
    '',
    'ok',
    'ok',
    '-ok-',
    'i-get-it-a_a_a',
    'really-',
    'really_______',
    'metisse',
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg, $testNumber) {

    $res = CaseTool::toDog($value);
    if ($expected !== $res) {
        ComparisonErrorTableTool::collect($testNumber, $expected, $res);
    }
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);
ComparisonErrorTableTool::display();