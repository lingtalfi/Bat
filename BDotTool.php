<?php

namespace Ling\Bat;


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
     * Returns an array containing the components of the given path.
     *
     * Escaped dots are returned as is by default, but this method can unescape them on the fly
     * by setting the keepEscapedDots option to false.
     *
     *
     * For instance
     * ------------
     *
     * (with keepEscapedDots=true)
     * my => [my]
     * my.one => [my, one]
     * my.one\.two.three => [my, one\.two, three]
     *
     * (with keepEscapedDots=false)
     * my => [my]
     * my.one => [my, one]
     * my.one\.two.three => [my, one.two, three]
     *
     *
     *
     * @param string $path
     * @param bool $keepEscapedDots
     * @return array
     */
    public static function getPathComponents(string $path, bool $keepEscapedDots = true): array
    {
        if (false === strpos($path, '.')) {
            return [$path];
        }
        if (false === strpos($path, '\.')) {
            return explode(".", $path);
        }
        $sUnguessable = '-_|dot-unguessable|_-';
        $path = str_replace('\.', $sUnguessable, $path);
        $parts = explode('.', $path);
        array_walk($parts, function (&$v) use ($sUnguessable, $keepEscapedDots) {
            if (true === $keepEscapedDots) {
                $v = str_replace($sUnguessable, '\.', $v);
            } else {
                $v = str_replace($sUnguessable, '.', $v);
            }
        });
        return $parts;
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
                    $parts = array_map(function ($v) use ($beeDot) {
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