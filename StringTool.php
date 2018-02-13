<?php

namespace Bat;

/*
 * LingTalfi 2015-10-14
 */
use Tiphaine\TiphaineTool;

class StringTool
{
    private static $irregular = [
        'woman' => 'women',
        'man' => 'men',
        'child' => 'children',
        'tooth' => 'teeth',
        'foot' => 'feet',
        'person' => 'people',
        'leaf' => 'leaves',
        'mouse' => 'mice',
        'goose' => 'geese',
        'half' => 'halves',
        'knife' => 'knives',
        'wife' => 'wives',
        'life' => 'lives',
        'elf' => 'elves',
        'loaf' => 'loaves',
        'potato' => 'potatoes',
        'tomato' => 'tomatoes',
        'cactus' => 'cacti',
        'focus' => 'foci',
        'fungus' => 'fungi',
        'nucleus' => 'nuclei',
        'syllabus' => 'syllabi',
        'analysis' => 'analyses',
        'diagnosis' => 'diagnoses',
        'oasis' => 'oases',
        'thesis' => 'theses',
        'crisis' => 'crises',
        'phenomenon' => 'phenomena',
        'criterion' => 'criteria',
        'datum' => 'data',
    ];





    public static function autoCast($string)
    {
        return TiphaineTool::autoCast($string);
    }


    /**
     * Nomenclature from
     * https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md
     */
    public static function camelCase2Constant($str)
    {
        return CaseTool::camel2Constant($str);
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
     *
     * The $keyPrefix allows us to prefix with "data-" for instance.
     *
     */
    public static function htmlAttributes(array $attributes, $keyPrefix = "")
    {
        $s = '';
        foreach ($attributes as $k => $v) {
            if (is_numeric($k)) {
                $s .= ' ';
                $s .= htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
            } else {
                if (null !== $v) {
                    $s .= ' ';
                    $s .= $keyPrefix . htmlspecialchars($k, ENT_QUOTES, 'UTF-8') . '="' . htmlspecialchars($v, ENT_QUOTES, 'UTF-8') . '"';
                }
            }
        }
        return $s;
    }


    /**
     * Stolen from OrmToolsHelper (OrmTools planet)
     */
    public static function getPlural($word)
    {

        /**
         * http://www.ef.com/english-resources/english-grammar/singular-and-plural-nouns/
         */

        if (array_key_exists($word, self::$irregular)) {
            return self::$irregular[$word];
        }

        $lastLetter = substr($word, -1);
        switch ($lastLetter) {
            case "y":
                $word = substr($word, 0, -1) . 'ies';
                break;
            case "s":
            case "x":
            case "z":
                $word .= 'es';
                break;
            default:
                $lastTwoLetters = substr($word, -2);
                switch ($lastTwoLetters) {
                    case "ch":
                    case "sh":
                        $word .= 'es';
                        break;
                    default:
                        $word .= "s";
                        break;
                }
                break;
        }

        return $word;
    }


    public static function getUniqueCssId($prefix = "a")
    {
        return $prefix . md5(uniqid($prefix, true));
    }


    /**
     * Drop the absoluteBaseDir string in front of the absolutePath.
     *
     * If it's not in front, the returned value depends on the default parameter:
     *  - if default is null, the absolutePath is returned
     *  - else default is returned
     *
     *
     *
     * @param $absoluteBaseDir , absolute path to the base dir containing the absolutePath
     * @param $absolutePath , absolute path to a resource
     * @return string|mixed, a relative path, starting with a slash (at least on linux,
     *          it will probably NOT WORK on windows),
     *          or the $default parameter value otherwise.
     */
    public static function relativePath($absoluteBaseDir, $absolutePath, $default = null)
    {
        if (0 === strpos($absolutePath, $absoluteBaseDir)) {
            $p = explode($absoluteBaseDir, $absolutePath, 2);
            return array_pop($p);
        }
        if (null === $default) {
            return $absolutePath;
        }
        return $default;
    }

    public static function removeAccents($str)
    {
        static $map = [
            // single letters
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'ą' => 'a',
            'å' => 'a',
            'ā' => 'a',
            'ă' => 'a',
            'ǎ' => 'a',
            'ǻ' => 'a',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Ą' => 'A',
            'Å' => 'A',
            'Ā' => 'A',
            'Ă' => 'A',
            'Ǎ' => 'A',
            'Ǻ' => 'A',


            'ç' => 'c',
            'ć' => 'c',
            'ĉ' => 'c',
            'ċ' => 'c',
            'č' => 'c',
            'Ç' => 'C',
            'Ć' => 'C',
            'Ĉ' => 'C',
            'Ċ' => 'C',
            'Č' => 'C',

            'ď' => 'd',
            'đ' => 'd',
            'Ð' => 'D',
            'Ď' => 'D',
            'Đ' => 'D',


            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ę' => 'e',
            'ē' => 'e',
            'ĕ' => 'e',
            'ė' => 'e',
            'ě' => 'e',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ę' => 'E',
            'Ē' => 'E',
            'Ĕ' => 'E',
            'Ė' => 'E',
            'Ě' => 'E',

            'ƒ' => 'f',


            'ĝ' => 'g',
            'ğ' => 'g',
            'ġ' => 'g',
            'ģ' => 'g',
            'Ĝ' => 'G',
            'Ğ' => 'G',
            'Ġ' => 'G',
            'Ģ' => 'G',


            'ĥ' => 'h',
            'ħ' => 'h',
            'Ĥ' => 'H',
            'Ħ' => 'H',

            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ĩ' => 'i',
            'ī' => 'i',
            'ĭ' => 'i',
            'į' => 'i',
            'ſ' => 'i',
            'ǐ' => 'i',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ĩ' => 'I',
            'Ī' => 'I',
            'Ĭ' => 'I',
            'Į' => 'I',
            'İ' => 'I',
            'Ǐ' => 'I',

            'ĵ' => 'j',
            'Ĵ' => 'J',

            'ķ' => 'k',
            'Ķ' => 'K',


            'ł' => 'l',
            'ĺ' => 'l',
            'ļ' => 'l',
            'ľ' => 'l',
            'ŀ' => 'l',
            'Ł' => 'L',
            'Ĺ' => 'L',
            'Ļ' => 'L',
            'Ľ' => 'L',
            'Ŀ' => 'L',


            'ñ' => 'n',
            'ń' => 'n',
            'ņ' => 'n',
            'ň' => 'n',
            'ŉ' => 'n',
            'Ñ' => 'N',
            'Ń' => 'N',
            'Ņ' => 'N',
            'Ň' => 'N',

            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ð' => 'o',
            'ø' => 'o',
            'ō' => 'o',
            'ŏ' => 'o',
            'ő' => 'o',
            'ơ' => 'o',
            'ǒ' => 'o',
            'ǿ' => 'o',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ō' => 'O',
            'Ŏ' => 'O',
            'Ő' => 'O',
            'Ơ' => 'O',
            'Ǒ' => 'O',
            'Ǿ' => 'O',


            'ŕ' => 'r',
            'ŗ' => 'r',
            'ř' => 'r',
            'Ŕ' => 'R',
            'Ŗ' => 'R',
            'Ř' => 'R',


            'ś' => 's',
            'š' => 's',
            'ŝ' => 's',
            'ş' => 's',
            'Ś' => 'S',
            'Š' => 'S',
            'Ŝ' => 'S',
            'Ş' => 'S',

            'ţ' => 't',
            'ť' => 't',
            'ŧ' => 't',
            'Ţ' => 'T',
            'Ť' => 'T',
            'Ŧ' => 'T',


            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ũ' => 'u',
            'ū' => 'u',
            'ŭ' => 'u',
            'ů' => 'u',
            'ű' => 'u',
            'ų' => 'u',
            'ư' => 'u',
            'ǔ' => 'u',
            'ǖ' => 'u',
            'ǘ' => 'u',
            'ǚ' => 'u',
            'ǜ' => 'u',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ũ' => 'U',
            'Ū' => 'U',
            'Ŭ' => 'U',
            'Ů' => 'U',
            'Ű' => 'U',
            'Ų' => 'U',
            'Ư' => 'U',
            'Ǔ' => 'U',
            'Ǖ' => 'U',
            'Ǘ' => 'U',
            'Ǚ' => 'U',
            'Ǜ' => 'U',


            'ŵ' => 'w',
            'Ŵ' => 'W',

            'ý' => 'y',
            'ÿ' => 'y',
            'ŷ' => 'y',
            'Ý' => 'Y',
            'Ÿ' => 'Y',
            'Ŷ' => 'Y',

            'ż' => 'z',
            'ź' => 'z',
            'ž' => 'z',
            'Ż' => 'Z',
            'Ź' => 'Z',
            'Ž' => 'Z',


            // accentuated ligatures
            'Ǽ' => 'A',
            'ǽ' => 'a',
        ];
        return strtr($str, $map);
    }


    /**
     * Cuts a portion of a string, and replaces it with a replacement string.
     *
     * @param int $start
     *                  the position where to start the cut.
     *                  If start is bigger than the string's length,
     *                  then the text will be inserted at the end of the string.
     * @param int $length
     *                  the length of the cut
     * @param string $replacement
     *                  the replacement string
     * @return string
     */
    public static function replacePortion($string, $start, $length, $replacement)
    {
        $begin = mb_substr($string, 0, $start);
        $end = mb_substr($string, $start + $length);
        return $begin . $replacement . $end;
    }


    /**
     * Split the given (assumed) string into an array of multi-byte characters.
     * The internal encoding used is the one returned by the php's mb_internal_encoding function.
     *
     */
    public static function split($string)
    {
        $len = mb_strlen($string);
        $ret = [];
        for ($i = 0; $i < $len; $i++) {
            $ret[] = mb_substr($string, $i, 1);
        }
        return $ret;
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
        } else {
            trigger_error(sprintf("strPosAll expects needle argument to be string or numeric, %s given", gettype($needle)), E_USER_WARNING);
        }
        return $ret;
    }

    public static function ucfirst($string)
    {
        return mb_convert_case($string, MB_CASE_TITLE, 'UTF-8');
    }


    /**
     * @param $string string
     * @return array|mixed
     */
    public static function unserializeAsArray($string)
    {
        if (empty($string)) {
            return [];
        }
        return unserialize($string);
    }
}


