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


    public static function passwordVerify($password, $hash)
    {
        return (true === password_verify($password, $hash));
    }


    public static function passwordEncrypt($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

}