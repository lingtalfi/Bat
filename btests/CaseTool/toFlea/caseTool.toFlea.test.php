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
    'métisse',
    // dots
    'abraham.jpg',
    'abraham..jpg',
    'abraham/../...jpg',
    '..abraham..',
    // weird
    '"hoLLy"',
];

$b = [
    '',
    'ok',
    'ok',
    '-ok-',
    'i-get-it-a_a_a',
    'really-',
    'really_',
    'metisse',
    // dots
    'abraham.jpg',
    'abraham.jpg',
    'abraham.jpg',
    '.abraham.',
    // weird
    'holly',    
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg, $testNumber) {

    $res = CaseTool::toFlea($value);
    if ($expected !== $res) {
        ComparisonErrorTableTool::collect($testNumber, $expected, $res);
    }
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);
ComparisonErrorTableTool::display();