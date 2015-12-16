<?php

namespace Bat;

/*
 * LingTalfi 2015-12-16
 */
class ValidationTool
{


    public static function isEmail($string)
    {
        if (filter_var($string, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

}
