<?php

use Bat\CaseTool;
use PhpBeast\AuthorTestAggregator;
use PhpBeast\PrettyTestInterpreter;
use PhpBeast\Tool\ComparisonErrorTableTool;


require_once "bigbang.php";


$agg = AuthorTestAggregator::create();

$a = [
    '',
    'just a test sentence to start with',
    'and_now_real_shit',
    'and_now_real_XML',
    'and_now_real__XML',
    'AND_NOW_REAL__XML',
    '_AND_NOW_REAL__XML',
    'has No_Time',
    'stILL has No_Time',
];

$b = [
    '',
    'Just a test sentence to start with',
    'AndNowRealShit',
    'AndNowRealXml',
    'AndNowRealXml',
    'AndNowRealXml',
    'AndNowRealXml',
    'Has noTime',
    'Still has noTime',
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg, $testNumber) {
    $res = CaseTool::snakeToPascal($value);
    if ($expected !== $res) {
        ComparisonErrorTableTool::collect($testNumber, $expected, $res);
    }
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);
ComparisonErrorTableTool::display();