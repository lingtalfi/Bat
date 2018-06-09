<?php


namespace Bat;


class HashTool
{


    public static function getHashByArray(array $arr)
    {
        if ($arr) {
            asort($arr);
            return hash('ripemd160', serialize($arr));
        }
        return '';
    }

    public static function getRandomHash64()
    {
        if (function_exists('random_bytes')) {
            return substr(bin2hex(random_bytes(64)), 0, 64);
        }
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