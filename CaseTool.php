<?php

namespace Ling\Bat;

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
    public static function camel2Constant(string $str)
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


    public static function snakeToCamel(string $str)
    {
        return lcfirst(self::snakeToPascal($str));
    }

    public static function snakeToPascal(string $str)
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

    public static function snakeToFlexiblePascal(string $str)
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
    public static function toCamel(string $str)
    {
        $str = StringTool::removeAccents($str);
        $str = preg_replace('![^a-zA-Z0-9]!', '-', $str);
        $str = preg_replace('!-+!', '-', $str);
        $p = explode('-', $str);
        $first = strtolower(array_shift($p));
        $p = array_map(function ($v) {
            return ucfirst(strtolower($v));
        }, $p);

        return $first . implode('', $p);
    }


    public static function toConstant(string $str)
    {
        return strtoupper(self::toSnake($str));
    }

    public static function toDash(string $str)
    {
        $str = strtolower(StringTool::removeAccents($str));
        $str = preg_replace('![^a-zA-Z0-9]!', '-', $str);
        $str = preg_replace('!-+!', '-', $str);
        $str = trim($str, '-');
        return $str;
    }


    public static function toDog(string $str)
    {
        $str = strtolower(StringTool::removeAccents($str));
        $str = preg_replace('![^a-zA-Z0-9\s_-]!', '', $str);
        $str = preg_replace('!\s!', '-', $str);
        $str = preg_replace('!-+!', '-', $str);
        return $str;
    }

    public static function toFlea(string $str)
    {
        $str = strtolower(StringTool::removeAccents($str));
        $str = preg_replace('![^a-zA-Z0-9\s\._-]!', '', $str);
        $str = preg_replace('!\s!', '-', $str);
        $str = preg_replace('!-+!', '-', $str);
        $str = preg_replace('!_+!', '_', $str);
        $str = preg_replace('!\.+!', '.', $str);
        return $str;
    }


    public static function toFlexibleDash(string $str)
    {
        $str = StringTool::removeAccents($str);
        $str = preg_replace('![^a-zA-Z0-9]!', '-', $str);
        $str = preg_replace('!-+!', '-', $str);
        $str = trim($str, '-');
        return $str;
    }


    public static function toFlexiblePascal(string $str)
    {
        return ucfirst(self::toFlexibleCamel($str));
    }


    /**
     * Returns the [human flat case](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#humanflatcase) version of the given string.
     *
     * @param string $str
     * @return string
     */
    public static function toHumanFlatCase(string $str): string
    {
        $str = str_replace('_', ' ', $str);
        $str = preg_replace('!([a-z0-9])([A-Z])!', '$1 $2', $str);
        return strtolower($str);
    }

    /**
     * Returns a portable file name.
     * For more details: https://github.com/lingtalfi/NotationFan/blob/master/portable-filename.md
     *
     * @param string $fileName
     * @return string
     */
    public static function toPortableFilename(string $fileName): string
    {
        return preg_replace('![^a-zA-Z0-9._-]!', '', $fileName);

    }


    /**
     * Returns the [flexible camel](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#flexiblecamelcase) version of the given string.
     *
     *
     *
     * @param string $str
     * @return string
     */
    public static function toFlexibleCamel(string $str): string
    {
        $str = StringTool::removeAccents($str);
        $str = preg_replace('![^a-zA-Z0-9]!', '-', $str);
        $str = preg_replace('!-+!', '-', $str);
        $p = explode('-', $str);
        $first = lcfirst(array_shift($p));
        $p = array_map(function ($v) {
            return ucfirst($v);
        }, $p);

        return $first . implode('', $p);
    }


    /**
     * Returns the [pascal](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#pascalcase) version of the given string.
     *
     * @param string $str
     * @return string
     */
    public static function toPascal(string $str): string
    {
        return ucfirst(self::toCamel($str));
    }


    /**
     * Returns a php variable version of the given string.
     *
     * @param string $str
     * @return string
     */
    public static function toVariableName(string $str): string
    {
        return lcfirst(self::toFlexiblePascal(preg_replace('!^[0-9]*!', '', $str)));
    }


    public static function toSnake(string $str, $processUpperLetters = false)
    {
        if (true === $processUpperLetters) {
            $str = preg_replace('!([A-Z])!', '_$1', $str);
        }
        $str = strtolower(StringTool::removeAccents($str));
        $str = preg_replace('![^a-zA-Z0-9]!', '_', $str);
        $str = preg_replace('!_+!', '_', $str);
        $str = trim($str, '_');
        return $str;
    }


    public static function unsnake($str)
    {
        return self::snakeToRegular($str);
    }
}
