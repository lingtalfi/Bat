<?php

namespace Bat;

/*
 * LingTalfi 2015-12-20
 */
class ArrayTool
{


    public static function arrayUniqueRecursive(array $array)
    {
        $result = array_map("unserialize", array_unique(array_map("serialize", $array)));
        foreach ($result as $key => $value) {
            if (is_array($value)) {
                $result[$key] = self::arrayUniqueRecursive($value);
            }
        }
        return $result;
    }

    /**
     * Check that all given $keys exist (as keys) in the given $arr.
     * If not, returns the missing keys.
     *
     *
     * @param array $arr
     * @param array $keys
     * @return array|false
     *                  Returns false if there is no missing key.
     *
     */
    public static function getMissingKeys(array $arr, array $keys)
    {
        $missing = [];
        foreach ($keys as $key) {
            if (!array_key_exists($key, $arr)) {
                $missing[] = $key;
            }
        }
        if ($missing) {
            return $missing;
        }
        return false;
    }


    /**
     * Put the layer array on top of the base array,
     * and return an array containing only the base keys,
     * which values are replaced by the layer values if available.
     *
     * https://stackoverflow.com/questions/18240493/php-array-replace-without-creating-keys
     *
     * @param array $layer
     * @param array $base
     *
     *
     * @return array
     */
    public static function superimpose(array $layer, array $base)
    {
        return array_merge($base, array_intersect_key($layer, $base));
    }


}
