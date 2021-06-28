<?php

use Ling\Bat\FileSystemTool;
use Ling\Bat\StringTool;
use Ling\PhpBeast\AuthorTestAggregator;
use Ling\PhpBeast\PrettyTestInterpreter;

require_once __DIR__ . "/../../../../../bigbang.php";



$agg = AuthorTestAggregator::create();

$a = [
    [],
    ['required'],
    ['class' => 'doo'],
    ['class' => 'doo', 'required', "id" => "foo"],
    ['src' => '/cet-été/dummy'],
];

$b = [
    '',
    ' required',
    ' class="doo"',
    ' class="doo" required id="foo"',
    ' src="/cet-été/dummy"',
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg) {
    $res = StringTool::htmlAttributes($value);
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);