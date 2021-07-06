<?php


namespace Ling\Bat;

/**
 * The MiniCsvTool class.
 *
 * The "minicsv" string is a csv string, where the separator is the comma,
 * and values cannot contain comma themselves.
 *
 * It's designed to work with "clean" values only.
 *
 *
 *
 */
class MiniCsvTool
{

    /**
     * Returns the csv array from the given minicsv string.
     * Values from the returned array are always trimmed.
     *
     * @param string $miniCsv
     * @return array
     */
    public static function getCsvArray(string $miniCsv): array
    {
        $p = explode(",", $miniCsv);
        $p = array_map("trim", $p);
        return $p;
    }

    /**
     * Returns an array of key/value pairs defined in the given minicsv string.
     * Each csv value represents a key/value pair, which separator is the colon char (:) by default.
     *
     * If a value doesn't contain the pairDelimiter, the key of the returned pair becomes the value,
     * and the value of the pair is an empty string.
     *
     *
     * @param string $miniCsv
     * @param string $pairDelimiter
     * @return array
     */
    public static function getCsvPairs(string $miniCsv, string $pairDelimiter = ":"): array
    {
        $ret = [];
        $arr = self::getCsvArray($miniCsv);
        foreach ($arr as $v) {
            $p = explode($pairDelimiter, $v, 2);
            $key = array_shift($p);
            $value = array_shift($p);
            $ret[trim($key)] = trim($value);
        }
        return $ret;
    }

}