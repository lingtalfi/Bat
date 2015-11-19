<?php

namespace Bat;

/*
 * LingTalfi 2015-10-14
 */
class StringTool
{


    /**
     * Nomenclature from
     * https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md
     */
    public static function camelCase2Constant($str)
    {
        if (is_string($str)) {
            $str = preg_replace('!([a-z]+)([^a-z])!', '$1' . '_' . '$2', $str);
            $str = preg_replace('!([0-9]+)([^0-9])!', '$1' . '_' . '$2', $str);
            $str = strtoupper($str);
        }
        else {
            throw new \InvalidArgumentException(sprintf("string argument must be of type string, %s given", gettype($str)));
        }
        return $str;
    }


    /**
     * Take a string, and return an array containing two entries:
     *
     * - the string without the numerical suffix
     * - the numerical suffix or false if the last chars are not numerical
     *
     * For instance,
     *      hello68 => [hello, 68]
     *      hello => [hello, false]
     *      hello-78.79 => [hello78., 79]
     *      123 => ["", 123]
     *
     *
     */
    public static function cutNumericalSuffix($str)
    {
        $suffix = false;
        if (preg_match('!^(.*)([0-9]+)$!U', $str, $m)) {
            $str = $m[1];
            $suffix = (int)$m[2];
        }
        return [$str, $suffix];
    }


    /**
     * Returns an html attributes string based on the given array.
     * Support arguments with just value, like checked for example.
     *
     * Also, if an argument value is null, it is omitted;
     * this behaviour might be useful in this case where we define default attributes values,
     * then the client can unset them by setting a null value.
     *
     */
    public static function htmlAttributes(array $attributes)
    {
        $s = '';
        foreach ($attributes as $k => $v) {
            if (is_numeric($k)) {
                $s .= ' ';
                $s .= htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
            }
            else {
                if (null !== $v) {
                    $s .= ' ';
                    $s .= htmlspecialchars($k, ENT_QUOTES, 'UTF-8') . '="' . htmlspecialchars($v, ENT_QUOTES, 'UTF-8') . '"';
                }
            }
        }
        return $s;
    }


    /**
     * Replaces a portion of the string with another.
     * 
     * @param int $start
     *                  if start is bigger than the string's length,
     *                  then the text will be inserted at the end of the string.
     * @param int $length
     * @return string
     */
    public static function replacePortion($string, $start, $length, $replacement)
    {
        $begin = mb_substr($string, 0, $start);
        $end = mb_substr($string, $start + $length);
        return $begin . $replacement . $end;
    }
    
    
    
    /**
     * Returns an array containing all the positions of $needle in $haystack.
     * A warning E_USER_WARNING is generated if needle is not a string or a number.
     */
    public static function strPosAll($haystack, $needle, $offset = 0)
    {
        $ret = [];
        if (is_string($needle) || is_numeric($needle)) {
            $len = mb_strlen((string)$needle);
            while (false !== $pos = mb_strpos($haystack, $needle, $offset)) {
                $ret[] = $pos;
                $offset = $pos + $len;
            }
        }
        else {
            trigger_error(sprintf("strPosAll expects needle argument to be string or numeric, %s given", gettype($needle)), E_USER_WARNING);
        }
        return $ret;
    }
}


