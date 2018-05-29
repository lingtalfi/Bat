<?php

namespace Bat;

/*
 * LingTalfi 2015-12-20
 */
class ArrayTool
{


    public static function arrayKeyExistAll(array $keys, array $pool)
    {
        foreach ($keys as $key) {
            if (false === array_key_exists($key, $pool)) {
                return false;
            }
        }
        return true;
    }

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
     * Return an array with keys equal to values.
     *
     * @param array $values
     * @return array
     */
    public static function keysSameAsValues(array $values): array
    {
        $ret = [];
        foreach ($values as $value) {
            $ret[$value] = $value;
        }
        return $ret;
    }

    /**
     * Like php range function, but the ranges applies on both the values and the keys
     * (i.e. not just the values like the php range function does)
     *
     * @param $start
     * @param $end
     * @param int $step
     * @return array
     */
    public static function mirrorRange($start, $end, $step = 1)
    {
        return array_combine(range($start, $end, $step), range($start, $end, $step));
    }


    public static function removeEntry($entry, array &$arr)
    {
        if (false !== ($index = array_search($entry, $arr))) {
            unset($arr[$index]);
        }
    }


    /**
     * Insert the given row into the rows;
     *
     *
     * @param $index
     * @param array $entry
     * @param array $rows , an array with numerical keys, each value being an array.
     */
    public static function insertRowAfter(int $index, array $row, array &$rows)
    {
        $zeIndex = $index + 1;
        $start = array_slice($rows, 0, $zeIndex);
        $end = array_slice($rows, $zeIndex);
        $entryWrapped = [$row];
        $rows = array_merge($start, $entryWrapped, $end);

    }

    /**
     * Return the <base> array, with values overridden by
     * the <layer> (only if the key match).
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


    /**
     * @param array $arr
     * @param callable $callback
     * @param array $options
     *
     *
     * Example:
     * (this will add the link property to every node in the array recursively)
     *
     *
     * $linkFmt = "/mylink/{type}/{slug}";
     * ArrayTool::updateNodeRecursive($ret, function (array &$row) use ($linkFmt) {
     *      $row['link'] = str_replace([
     *          "{type}",
     *          "{slug}",
     *      ], [
     *          $row['type'],
     *          $row['slug'],
     *          ], $linkFmt);
     * });
     *
     *
     *
     *
     */
    public static function updateNodeRecursive(array &$arr, callable $callback, array $options = [])
    {
        $childrenKey = $options['childrenKey'] ?? "children";
        foreach ($arr as $k => $v) {
            call_user_func_array($callback, [&$v]);

            if (array_key_exists($childrenKey, $v) && $v[$childrenKey]) {
                $children = $v[$childrenKey];
                self::updateNodeRecursive($children, $callback, $options);
                $v[$childrenKey] = $children;
            }
            $arr[$k] = $v;
        }
    }

}
