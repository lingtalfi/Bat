<?php


namespace Bat;


use ArrayToString\ArrayToStringTool;
use BeeFramework\Bat\ReflectionTool;

class DebugTool
{

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
            return ArrayToStringTool::toPhpArray($thing);
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