<?php


namespace Bat;


class MathTool
{


    // https://stackoverflow.com/questions/27176367/all-combinations-of-r-elements-from-given-array-php
    public static function combinationsOf($k, $xs)
    {
        if ($k === 0) {
            return array(array());
        }
        if (count($xs) === 0) {
            return array();
        }
        $x = $xs[0];
        $xs1 = array_slice($xs, 1, count($xs) - 1);
        $res1 = self::combinationsOf($k - 1, $xs1);
        for ($i = 0; $i < count($res1); $i++) {
            array_splice($res1[$i], 0, 0, $x);
        }
        $res2 = self::combinationsOf($k, $xs1);
        return array_merge($res1, $res2);
    }
}