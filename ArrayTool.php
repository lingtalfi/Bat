<?php

namespace Ling\Bat;


use Ling\Bat\Exception\BatException;

/**
 * The ArrayTool class.
 * LingTalfi 2015-12-20 -> 2019-09-17
 */
class ArrayTool
{


    /**
     * Checks that every given keys exist in the given pool array, and by default
     * returns the result as a boolean.
     *
     * If the throwEx flag is set to true, then this method throws an exception if
     * one key (or more) is not found.
     *
     *
     *
     * @param array|string $keys
     * @param array $pool
     * @param bool $throwEx
     * @return bool
     * @throws \Exception
     */
    public static function arrayKeyExistAll($keys, array $pool, bool $throwEx = false)
    {
        if (false === is_array($keys)) {
            $keys = [$keys];
        }
        foreach ($keys as $key) {
            if (false === array_key_exists($key, $pool)) {
                if (true === $throwEx) {
                    throw new BatException("Key not found: $key.");
                }
                return false;
            }
        }
        return true;
    }


    /**
     * Merge the given arrays and return a resulting array,
     * appending numeric keys, and replacing existing associative keys.
     *
     * This algorithm merges arrays together, and when a value already exists, one of the two cases occur:
     *
     * - either the replaced value is an array, in which case the new value gets appended to that array
     * - or the replaced value is a scalar value (i.e. not an array), in which case the new value completely replaces the old one
     *
     *
     *
     * Technically, the merging rules are basically the following:
     * - set the associative key only if it doesn't already exist
     * - if it's a numeric key, append it
     *
     *
     * Example:
     * -----------
     * Given array1:
     * array(1) {
     *      ["example"] => array(2) {
     *          ["fruits"] => array(2) {
     *              [0] => string(5) "apple"
     *              [1] => string(6) "banana"
     *          }
     *          ["numbers"] => array(2) {
     *              ["one"] => int(1)
     *              ["two"] => int(2)
     *          }
     *      }
     * }
     *
     *
     * and array2:
     * array(1) {
     *      ["example"] => array(3) {
     *          ["fruits"] => array(1) {
     *              [0] => string(6) "cherry"
     *          }
     *          ["sports"] => array(2) {
     *              [0] => string(4) "judo"
     *              [1] => string(6) "karate"
     *          }
     *          ["numbers"] => array(1) {
     *              ["two"] => int(222)
     *          }
     *      }
     * }
     *
     *
     * The result of Bat::arrayMergeReplaceRecursive([array1, array2]) gives:
     *
     * array(1) {
     *      ["example"] => array(3) {
     *          ["fruits"] => array(3) {
     *              [0] => string(5) "apple"
     *              [1] => string(6) "banana"
     *              [2] => string(6) "cherry"
     *          }
     *          ["numbers"] => array(2) {
     *              ["one"] => int(1)
     *              ["two"] => int(222)
     *          }
     *          ["sports"] => array(2) {
     *              [0] => string(4) "judo"
     *              [1] => string(6) "karate"
     *          }
     *      }
     * }
     *
     *
     *
     *
     *
     *
     *
     * @param array $arrays
     * @return array
     */
    public static function arrayMergeReplaceRecursive(array $arrays)
    {
        $arr = [];
        foreach ($arrays as $array) {
            foreach ($array as $k => $v) {
                if (is_numeric($k)) {
                    $arr[] = $v;
                } else {

                    if (!array_key_exists($k, $arr)) {
                        $arr[$k] = $v;
                    } else {
                        if (is_array($v) && !empty($v)) {
                            $arr[$k] = self::arrayMergeReplaceRecursive([$arr[$k], $v]);
                        } else {
                            $arr[$k] = $v;
                        }
                    }
                }
            }
        }
        return $arr;
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
     * Returns the $array, without the entries which keys are NOT listed in $allowed.
     *
     * Example:
     * ---------
     * $array = [
     *      "one" => 11,
     *      "two" => 22,
     *      "garbage" => 123,
     * ];
     *
     * $allowed = ["one", "two"];
     *
     * az(ArrayTool::filterByAllowed($array, $allowed));
     *
     * - one: 11
     * - two: 22
     *
     *
     *
     * @param array $array
     * @param array $allowed
     * @return array
     */
    public static function filterByAllowed(array $array, array $allowed): array
    {
        return array_intersect_key($array, array_flip($allowed));
    }


    /**
     * Filters the elements of an array recursively, using a given callable.
     *
     * The callable function must return a boolean (whether to accept the value or remove it).
     *
     * See the examples from the doc for more details.
     *
     *
     * @param array $array
     * @param callable $callback
     * @return array
     */
    public static function filterRecursive(array $array, callable $callback): array
    {
        foreach ($array as $k => $v) {
            $res = call_user_func($callback, $v);
            if (false === $res) {
                unset($array[$k]);
            } else {
                if (is_array($v)) {
                    $array[$k] = self::filterRecursive($v, $callback);
                }
            }
        }

        return $array;
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
     * Returns an array containing all the key/value pairs of the given $array which keys are in the given $keys.
     * See the examples for more information.
     *
     *
     * @param array $array
     * @param array $keys
     * @return array
     */
    public static function intersect(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }

    /**
     * Returns whether the given argument is an array which first key is numerical.
     *
     * Note: supposedly if the first key is numerical, chances are that the whole array is numerical,
     * depending on the array structure. This method was designed to give a quick guess, as opposed to
     * check all the keys of the array, which might take too long depending on the array size.
     *
     *
     *
     *
     * @param $array
     * @param bool $emptyIsValid
     * Whether an empty array is considered a valid numerically indexed array (default is true)
     *
     * @return bool
     */
    public static function isNumericalArray($array, $emptyIsValid = true): bool
    {
        if (is_array($array)) {
            if (empty($array)) {
                return $emptyIsValid;
            }
            return is_numeric(key($array));
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


    /**
     * This method returns the array corresponding to an object, including non public members.
     *
     *
     * @param object $obj
     * @return array
     * @throws \Exception
     */
    public static function objectToArray(object $obj)
    {
        $reflectionClass = new \ReflectionClass(get_class($obj));
        $array = [];
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($obj);
            $property->setAccessible(false);
        }
        return $array;
    }


    public static function removeEntry($entry, array &$arr)
    {
        if (false !== ($index = array_search($entry, $arr))) {
            unset($arr[$index]);
        }
    }


    /**
     * Returns a one dimensional numerically indexed array,
     * which values are the row[column] values.
     *
     * Note: we trust that the user provides consistent rows
     * (i.e. we don't loose time with checking the data).
     *
     *
     * @param array $rows
     * @param string $column
     * @return array
     */
    public static function reduce(array $rows, string $column): array
    {
        $ret = [];
        foreach ($rows as $row) {
            $ret[] = $row[$column];
        }
        return $ret;
    }


    /**
     * Parses the given array recursively replacing the tag keys by their values
     * directly in the array values, using str_replace under the hood.
     *
     * Tags is an array of key/value pairs,
     * such as:
     *
     * - {myTag} => 123
     * - {myTag2} => abc
     *
     * Only scalar values are accepted.
     * If you need to replace with non scalar values such as arrays, you might
     * be interested in the [ArrayVariableResolver]https://github.com/lingtalfi/ArrayVariableResolver tool.
     *
     * See the online documentation for some concrete examples.
     *
     *
     * @param array $tags
     * @param array &$array
     * @return array
     */
    public static function replaceRecursive(array $tags, array &$array): array
    {
        array_walk_recursive($array, function (&$v) use ($tags) {
            $v = str_replace(array_keys($tags), array_values($tags), $v);
        });
        return $array;
    }


    /**
     * Returns the given $defaults array,
     * with values possibly overridden by the $array.
     *
     * Example
     * ----------
     *
     * $array = [
     *      "color" => "blue",
     *      "hobby" => "music",
     * ];
     *
     * $defaults = [
     *      "color" => "green",
     *      "sport" => "judo",
     *      "fruit" => "apple",
     * ];
     *
     *
     * a(ArrayTool::superimpose($array, $defaults));
     *
     * - color: blue
     * - sport: judo
     * - fruit: apple
     *
     *
     *
     *
     * @param array $array
     * @param array $defaults
     * @return array
     */
    public static function superimpose(array $array, array $defaults)
    {
        return array_merge($defaults, array_intersect_key($array, $defaults));
    }


    /**
     * Updates an array recursively, like (php) array_walk_recursive, but adapted for nested item structures.
     *
     * A nested item structure looks like this for instance:
     *
     * -
     *      id: one
     *      label: One
     *      children: []
     * -
     *      id: two
     *      label: Two
     *      children:
     *          -
     *               id: three
     *               label: Three
     *               children: []
     *
     *
     *
     *
     *
     *
     *
     *
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


    /**
     * Walks the given rows recursively, triggering the given callback on each row.
     *
     * A row is an array.
     * Generally all rows have the same structure.
     * A row can contain other rows, in which case it's a parent row.
     * The parent row holds its children using a **children** key, which defaults to **children** (third argument).
     *
     *
     * The callable receives the row as its only argument.
     * If the row is defined as a reference, then we can update the row from inside the callable.
     *
     *
     * By default, the callable is called for every row, including the parent rows.
     * If you want to trigger the callable only on leaves (rows with no children), you can set
     * the $triggerCallableOnParents flag to false.
     *
     *
     * @param array $arr
     * @param callable $callback
     * @param string $childrenKey =children
     * @param bool $triggerCallableOnParents =true
     */
    public static function walkRowsRecursive(array &$arr, callable $callback, string $childrenKey = "children", bool $triggerCallableOnParents = true): void
    {
        foreach ($arr as $k => &$v) {
            $isParent = array_key_exists($childrenKey, $v) && $v[$childrenKey];

            if (false === $isParent || true === $triggerCallableOnParents) {
                call_user_func_array($callback, [&$v]);
            }

            if (true === $isParent) {
                $children = $v[$childrenKey];
                self::walkRowsRecursive($children, $callback, $childrenKey);
                $v[$childrenKey] = $children;
            }
        }
    }

}
