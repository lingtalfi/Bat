<?php

use Bat\FileSystemTool;
use Bat\StringTool;
use PhpBeast\AuthorTestAggregator;
use PhpBeast\PrettyTestInterpreter;

require_once "bigbang.php";


//------------------------------------------------------------------------------/
// 
//------------------------------------------------------------------------------/
$agg = AuthorTestAggregator::create();

$a = [
    ['', 0, 0, ''],
    ['abcdefgh', 0, 0, ''],
    ['abcdefgh', 0, 1, ''],
    ['abcdefgh', 0, 1, 'ppp'],
    ['abcdefgh', 2, 1, 'ppp'],
    ['aéliope', 2, 1, 'ppp'],
    ['aéliope', 2, 4, 'ppp'],
];

$b = [
    '',
    'abcdefgh',
    'bcdefgh',
    'pppbcdefgh',
    'abpppdefgh',
    'aépppiope',
    'aépppe',
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg) {
    list($string, $start, $length, $replacement) = $value;
    $res = StringTool::replacePortion($string, $start, $length, $replacement);
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);