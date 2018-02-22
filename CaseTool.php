<?php

namespace Bat;

/**
 * LingTalfi 2015-12-21
 * @link https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md
 */
class CaseTool
{

    /**
     * Nomenclature from
     * https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md
     */
    public static function camel2Constant($str)
    {
        if (is_string($str)) {
            $str = preg_replace('!([a-z]+)([^a-z])!', '$1' . '_' . '$2', $str);
            $str = preg_replace('!([0-9]+)([^0-9])!', '$1' . '_' . '$2', $str);
            $str = strtoupper($str);
        } else {
            throw new \InvalidArgumentException(sprintf("string argument must be of type string, %s given", gettype($str)));
        }
        return $str;
    }

    public static function snakeToCamel($str)
    {
        return lcfirst(self::snakeToPascal($str));
    }

    public static function snakeToPascal($str)
    {
        if (is_string($str)) {
            // splits using one or more consecutive underscores
            $arr = preg_split('!_+!', $str);

            // all components to lower case, then first letter to upper case and returns the components without spaces
            array_walk($arr, function (&$v) {
                $v = ucfirst(strtolower($v));
            });
            $str = implode('', $arr);
        } else {
            throw new \InvalidArgumentException(sprintf("string argument must be of type string, %s given", gettype($str)));
        }
        return $str;
    }

    public static function snakeToFlexiblePascal($str)
    {
        if (is_string($str)) {
            // splits using one or more consecutive underscores
            $arr = preg_split('!_+!', $str);

            // for all components, first letter to upper case and returns the components without spaces
            array_walk($arr, function (&$v) {
                $v = ucfirst($v);
            });
            $str = implode('', $arr);
            $str = str_replace(' ', '', $str);

        } else {
            throw new \InvalidArgumentException(sprintf("string argument must be of type string, %s given", gettype($str)));
        }
        return $str;
    }


    public static function snakeToRegular($str)
    {
        if (is_string($str)) {
            // splits using one or more consecutive underscores
            $arr = preg_split('!_+!', $str);
            $str = implode(' ', $arr);
        } else {
            throw new \InvalidArgumentException(sprintf("string argument must be of type string, %s given", gettype($str)));
        }
        return $str;
    }


    /**
     *
     *
     * 2017-11-30:
     * fix: choice-listWithNames -> choiceListwithnames
     * now is: choice-listWithNames -> choiceListWithNames
     */
    public static function toCamel($str)
    {
        $str = StringTool::removeAccents($str);
        $str = preg_replace('![^a-zA-Z0-9]!', '-', $str);
        $str = preg_replace('!-+!', '-', $str);
        $p = explode('-', $str);
        $first = strtolower(array_shift($p));
        $p = array_map(function ($v) {
            /**
             * This technique is not perfect as it might cause problems with letters just after numbers:
             *
             * my2Cent
             *
             * would be reduced to
             *
             * my2cent   (culprit lowercase c after the 2)
             *
             * @todo-ling: fix this...
             *
             */
            return ucfirst($v);
        }, $p);

        return $first . implode('', $p);
    }

    public static function toDog($str)
    {
        $str = strtolower(StringTool::removeAccents($str));
        $str = preg_replace('![^a-zA-Z0-9\s_-]!', '', $str);
        $str = preg_replace('!\s!', '-', $str);
        $str = preg_replace('!-+!', '-', $str);
        return $str;
    }

    public static function toFlea($str)
    {
        $str = strtolower(StringTool::removeAccents($str));
        $str = preg_replace('![^a-zA-Z0-9\s\._-]!', '', $str);
        $str = preg_replace('!\s!', '-', $str);
        $str = preg_replace('!-+!', '-', $str);
        $str = preg_replace('!_+!', '_', $str);
        $str = preg_replace('!\.+!', '.', $str);
        return $str;
    }


    public static function toSnake($str, $processUpperLetters = false)
    {
        if (true === $processUpperLetters) {
            $str = preg_replace('!([A-Z])!', '_$1', $str);
        }


        $str = strtolower(StringTool::removeAccents($str));
        $str = preg_replace('![^a-zA-Z0-9\s_]!', '', $str);


        $str = preg_replace('!\s!', '_', $str);
        $str = preg_replace('!_+!', '_', $str);
        $str = trim($str, '_');
        return $str;
    }

    public static function unsnake($str)
    {
        return self::snakeToRegular($str);
    }
}
