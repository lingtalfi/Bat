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
    ['Hum, hello, did you hear me say hello?', 'hello', 0],
    ["Cet été, il faisait beau. Cet été c'était bien.", 'été', 0],
    ["Cet été, il faisait beau. Cet été c'était bien.", 'été', 4],
    ["Cet été, il faisait beau. Cet été c'était bien.", 'été', 5],
    ["Cet été, il faisait beau. Cet été c'était bien.", 'été', 0, 'iso-8859-1'],
];

$b = [
    [5, 32],
    [4, 30],
    [4, 30],
    [30],
    [4, 32],
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg) {

    $encoding = 'utf-8';
    if (array_key_exists(3, $value)) {
        $encoding = $value[3];
    }
    mb_internal_encoding($encoding);


    list($haystack, $needle, $offset) = $value;
    $res = StringTool::strPosAll($haystack, $needle, $offset);
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);