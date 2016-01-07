<?php

use Bat\StringTool;
use PhpBeast\AuthorTestAggregator;
use PhpBeast\PrettyTestInterpreter;
use PhpBeast\Tool\ComparisonErrorTableTool;

require_once "bigbang.php";


$agg = AuthorTestAggregator::create();

$a = [
    // easy
    '',
    'a',
    'après',
    'dédé fait la fête ?',
    // hard
    'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
    'ŻŹĆŃĄŚŁĘÓżźćńąśłęó',
    'qqqqŻŹĆŃĄŚŁĘÓżźćńąśłęóqqq',
    'ŠŽšžŸÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåçèéêëìíîïðñòóôõöøùúûüýÿ',       
    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåçèéêëìíîïñòóôõöøùúûüýÿ',
    'ĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬĭĮįİĴĵĶķ',
    'ĹĺĻļĽľĿŀŁłŃńŅņŇňŉŌōŎŏŐőŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽž',
    'ſƒƠơƯưǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǺǻǾǿ',
    'Ǽǽ',
];

$b = [
    // easy
    '',
    'a',
    'apres',
    'dede fait la fete ?',
    // hard
    'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY',
    'ZZCNASLEOzzcnasleo',
    'qqqqZZCNASLEOzzcnasleoqqq',
    'SZszYAAAAAACEEEEIIIIDNOOOOOOUUUUYaaaaaaceeeeiiiionoooooouuuuyy',
    'AAAAAACEEEEIIIIDNOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy',
    'AaAaAaCcCcCcCcDdDdEeEeEeEeEeGgGgGgGgHhHhIiIiIiIiIJjKk',
    'LlLlLlLlLlNnNnNnnOoOoOoRrRrRrSsSsSsSsTtTtTtUuUuUuUuUuUuWwYyYZzZzZz',
    'ifOoUuAaIiOoUuUuUuUuUuAaOo',
    'Aa',
];


$agg->addTestsByColumn($a, $b, function ($value, $expected, &$msg, $testNumber) {

    $res = StringTool::removeAccents($value);
    if ($expected !== $res) {
        ComparisonErrorTableTool::collect($testNumber, $expected, $res);
    }
    return ($expected === $res);
});


PrettyTestInterpreter::create()->execute($agg);
ComparisonErrorTableTool::display();