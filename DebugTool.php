<?php


namespace Ling\Bat;


use Ling\ArrayToString\ArrayToStringTool;
use Ling\BeeFramework\Bat\ReflectionTool;


/**
 * The DebugTool class.
 */
class DebugTool
{


    public static function dump()
    {
        foreach (func_get_args() as $arg) {
            ob_start();
            var_dump($arg);
            $output = ob_get_clean();
            if ('1' !== ini_get('xdebug.default_enable')) {
                $output = preg_replace("!\]\=\>\n(\s+)!m", "] => ", $output);
            }
            if ('cli' === PHP_SAPI) {
                echo $output;
            } else {
                echo '<pre>' . $output . '</pre>';
            }
        }
    }

    public static function dumpVar($var, $return = true)
    {

        ob_start();
        var_dump($var);
        $output = ob_get_clean();


        ob_start();
        if ('1' !== ini_get('xdebug.default_enable')) {
            $output = preg_replace("!\]\=\>\n(\s+)!m", "] => ", $output);
        }
        if ('cli' === PHP_SAPI) {
            echo $output;
        } else {
            echo '<pre>' . $output . '</pre>';
        }
        $ret = ob_get_clean();
        if (true === $return) {
            return $ret;
        }
        echo $ret;
    }


    public static function getArrayPartial(array $arr, array $options = [])
    {
        $ret = [];
        $includes = $options['include'] ?? [];
        $excludes = $options['exclude'] ?? [];
        if ($includes) {
            foreach ($includes as $dotPath) {
                $ret[$dotPath] = BDotTool::getDotValue($dotPath, $arr);
            }
        } elseif ($excludes) {
            $ret = $arr;
            foreach ($excludes as $dotPath) {
                BDotTool::unsetDotValue($dotPath, $ret);
            }
        }
        return $ret;
    }


    public static function toString($thing)
    {
        /**
         * inspired by
         *
         * BeeFramework\Bat\VarTool::toString method
         *
         */
        if (is_bool($thing)) {
            $s = (true === $thing) ? 'true' : 'false';
            return 'bool(' . $s . ')';
        } elseif (is_null($thing)) {
            return 'null';
        } elseif ($thing instanceof \Closure) {
            return self::closureToString($thing);
        } elseif (is_callable($thing)) {
            return self::callableToString($thing);
        } elseif (is_array($thing)) {
            return ArrayToStringTool::toInlinePhpArray($thing);
        } elseif (is_scalar($thing)) {
            return $thing;
        } elseif (is_object($thing)) {
            return 'object(' . get_class($thing) . ')';
        }
        return (string)$thing;
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    private static function callableToString($var)
    {
        $ret = "";
        if (is_callable($var)) {
            if (is_string($var)) {
                $ret = 'callable(' . $var . ')';
            } elseif (is_array($var) && isset($var[0]) && isset($var[1])) {

                // static?
                $o = new \ReflectionClass($var[0]);
                $m = $o->getMethod($var[1]); // throws a \ReflectionException if the method does not exist

                if (true === $m->isStatic()) {
                    $char = '::';
                } else {
                    $char = '->';
                }
                $ret = 'callable(' . $o->getName() . $char . $var[1] . '(' . ReflectionTool::getMethodParametersAsString($m) . '))';
            } else {
                throw new \LogicException("Unknown case of callable");
            }
        }
        return $ret;
    }

    private static function closureToString($var)
    {
        if ($var instanceof \Closure) {
            $o = new \ReflectionFunction($var);
            $args = [];
            foreach ($o->getParameters() as $p) {
                $args[] = ReflectionTool::getParameterAsString($p);
            }
            return 'closure(' . implode(', ', $args) . ')';
        }
        return false;
    }


}