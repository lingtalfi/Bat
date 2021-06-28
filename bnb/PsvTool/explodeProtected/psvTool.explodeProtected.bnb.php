<?php

use Ling\Bat\CaseTool;
use Ling\Bat\PsvTool;
use Ling\PhpBeast\AuthorTestAggregator;
use Ling\PhpBeast\PrettyTestInterpreter;
use Ling\PhpBeast\Tool\ComparisonErrorTableTool;


require_once __DIR__ . "/../../../../../bigbang.php";


$agg = AuthorTestAggregator::create();

$a = [
    "'M','F'", // simple enum
    "'Méchant','F'", // testing accent (utf-8)
    "'Aujourd\'hui','F'", // testing escaping
    "'Aujourd\'hui','F', \"paul\"", // testing different quote types
    "'Aujourd\'hui','F', \"paul\", \"p\\\"eter\"", // testing different quote types 2
    "'a', 'b', , nope, 'd',  ", // testing malformed values
];

$b = [
    [
        "M",
        "F",
    ],
    [
        "Méchant",
        "F",
    ],
    [
        "Aujourd'hui",
        "F",
    ],
    [
        "Aujourd'hui",
        "F",
        "paul",
    ],
    [
        "Aujourd'hui",
        "F",
        "paul",
        'p"eter',
    ],
    [
        "a",
        "b",
        "",
        "",
        "d",
        "",
    ],
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg, $testNumber) {
    $res = PsvTool::explodeProtected($value);
    if ($expected !== $res) {
        ComparisonErrorTableTool::collect($testNumber, $expected, $res);
    }
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);
ComparisonErrorTableTool::display();