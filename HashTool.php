<?php


namespace Bat;


class HashTool
{


    public static function getHashByArray(array $arr)
    {
        if ($arr) {
            ksort($arr);
            return hash('ripemd160', serialize($arr));
        }
        return '';
    }

    public static function getRandomHash64()
    {
        return hash('sha256', uniqid() . ")" . rand(0, 80));
    }

}