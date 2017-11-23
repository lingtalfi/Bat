<?php

namespace Bat;


/**
 *
 * This was partially stolen from the bee framework.
 * https://github.com/lingtalfi/bee/blob/master/bee/modules/Bee/Bat/BdotTool.php
 *
 *
 */
class BDotTool
{

    public static function getDotValue($path, array $array, $default = null, &$found = false)
    {
        return self::doGetValue($path, $array, $default, $found);
    }


    /**
     * @return bool
     */
    public static function hasDotValue($path, array $array)
    {
        $found = false;
        self::doGetValue($path, $array, null, $found);
        return $found;
    }


    /**
     * Sets a value in an array.
     * Note: if the key does not exist, it will be created.
     * Also, if a key along the path is not an array, it will be overwritten and become an array.
     */
    public static function setDotValue($path, $replacement, &$array)
    {
        if (null === $path) {
            if (is_array($replacement)) {
                $array = $replacement;
                return;
            } else {
                throw new \RuntimeException("Cannot replace the root array with a non array value");
            }
        }
        $beeDot = '__-BEE_DOT-__';
        $path = str_replace("\\.", $beeDot, $path);
        $parts = explode(".", $path);
        if (count($parts) > 1) {
            $key = str_replace($beeDot, '.', array_shift($parts));
            if (!array_key_exists($key, $array) || (array_key_exists($key, $array) && !is_array($array[$key]))) {
                $array[$key] = array();
            }
            self::setDotValue(implode('.', $parts), $replacement, $array[$key]);
        } else {
            $key = str_replace($beeDot, '.', array_shift($parts));
            $array[$key] = $replacement;
        }
    }

    public static function unsetDotValue($path, array &$array)
    {
        if (false === strpos($path, '.')) {
            unset($array[$path]);
        } else {
            $beeDot = '__-BEE_DOT-__';
            $path = str_replace("\\.", $beeDot, $path);
            $parts = explode(".", $path);
            $first = array_shift($parts);
            $first = str_replace($beeDot, '.', $first);
            if (array_key_exists($first, $array)) {
                if (count($parts) > 0) {
                    $parts = array_map(function($v) use($beeDot){
                        return str_replace($beeDot, "\\.", $v);
                    }, $parts);
                    $newPath = implode('.', $parts);
                    self::unsetDotValue($newPath, $array[$first]);
                } else {
                    unset($array[$first]);
                }
            }
        }
    }

    /**
     * - callback ( &?value, key, dotPath )
     */
    public static function walk(array &$a, $callback)
    {
        if (is_callable($callback)) {
            self::doWalk($a, $callback);
        } else {
            throw new \InvalidArgumentException("callback must be a valid php callback");
        }
    }
    //------------------------------------------------------------------------------/
    //
    //------------------------------------------------------------------------------/
    private static function doWalk(array &$a, \Closure $callback, $curPath = '')
    {
        array_walk($a, function (&$v, $k) use ($curPath, $callback) {
            if (!empty($curPath)) {
                $curPath .= '.';
            }
            $curPath .= str_replace('.', '\.', $k);
            call_user_func_array($callback, [&$v, $k, $curPath]);
            if (is_array($v)) {
                self::doWalk($v, $callback, $curPath);
            }
        });
    }

    private static function doGetDotValue(array $paths, $array, $beeDot, $default = null, &$found = false)
    {
        if ($paths) {
            $seg = str_replace($beeDot, ".", array_shift($paths));
            if (array_key_exists($seg, $array)) {
                $value = $array[$seg];
                if ($paths) {
                    if (is_array($value)) {
                        $found = true;
                        return self::doGetDotValue($paths, $value, $beeDot, $default, $found);
                    } else {
                        $found = false;
                    }
                } else {
                    $found = true;
                    return $value;
                }
            } else {
                $found = false;
            }
        }
        return $default;
    }

    private static function doGetValue($path, array $array, $default = null, &$found = false)
    {
        if (null === $path) {
            $found = true;
            return $array;
        }
        if (false === strpos($path, '.')) {
            if (array_key_exists($path, $array)) {
                $value = $array[$path];
                $found = true;
            } else {
                $value = $default;
            }
        } else {
            $beeDot = '__-BEE_DOT-__';
            $path = str_replace("\\.", $beeDot, $path);
            $parts = explode(".", $path);
            $value = self::doGetDotValue($parts, $array, $beeDot, $default, $found);
        }
        return $value;
    }
}