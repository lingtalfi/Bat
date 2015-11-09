<?php

use Bat\StringTool;
use PhpBeast\AuthorTestAggregator;
use PhpBeast\PrettyTestInterpreter;

require_once "bigbang.php";


$agg = AuthorTestAggregator::create();

$a = [
    'camelCase',
    'thisIsNotCorrect',
    'simpleXML',
    'localDb2Remote',
    'notFound404',
];

$b = [
    'CAMEL_CASE',
    'THIS_IS_NOT_CORRECT',
    'SIMPLE_XML',
    'LOCAL_DB_2_REMOTE',
    'NOT_FOUND_404',
];


$c = [
    456,
    null,
    true,
    false,
];

$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg) {
    $res = StringTool::camelCase2Constant($value);
    return ($expected === $res);
});

$agg->addExceptionTests($c, function ($v) {
    StringTool::camelCase2Constant($v);
}, [
    '0-2' => 'InvalidArgumentException', // testing that the short name of the exception for tests 0,1,2 is InvalidArgumentException
    '3' => [
        'msgSub' => 'argument',  // testing that the exception message contains the "argument" substring
    ],
]);


PrettyTestInterpreter::create()->execute($agg);