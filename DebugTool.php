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


    /**
     *
     * Prints a dump for any variable(s) passed to this method, and exits.
     *
     * Objects are printed as class name to avoid too long to read dumps.
     *
     * Note: this method should be used in a web environment (i.e. no cli implementation yet).
     *
     */
    public static function dumpX()
    {
        foreach (func_get_args() as $arg) {
            self::doDumpX($arg);
        }
        exit;
    }

    /**
     *
     * Returns a dump of the given variable,
     * except that for objects, only the class name is returned.
     *
     * This method was created in order to avoid too long object debug dump...
     *
     *
     * Inspired by: https://www.php.net/manual/en/function.var-dump.php#105343
     *
     */
    protected static function doDumpX(&$var, $var_name = NULL, $indent = NULL, $reference = NULL)
    {
        $do_dump_indent = "<span style='color:#666666;'>|</span> &nbsp;&nbsp; ";
        $reference = $reference . $var_name;
        $keyvar = 'the_do_dump_recursion_protection_scheme';
        $keyname = 'referenced_object_name';

        // So this is always visible and always left justified and readable
        echo "<div style='text-align:left; background-color:white; font: 100% monospace; color:black;'>";

        if (is_array($var) && isset($var[$keyvar])) {
            $real_var = &$var[$keyvar];
            $real_name = &$var[$keyname];
            $type = ucfirst(gettype($real_var));
            echo "$indent$var_name <span style='color:#666666'>$type</span> = <span style='color:#e87800;'>&amp;$real_name</span><br>";
        } else {
            $var = array($keyvar => $var, $keyname => $reference);
            $avar = &$var[$keyvar];

            $type = ucfirst(gettype($avar));
            if ($type == "String") {
                $type_color = "<span style='color:green'>";
            } elseif ($type == "Integer") {
                $type_color = "<span style='color:red'>";
            } elseif ($type == "Double") {
                $type_color = "<span style='color:#0099c5'>";
                $type = "Float";
            } elseif ($type == "Boolean") {
                $type_color = "<span style='color:#92008d'>";
            } elseif ($type == "NULL") {
                $type_color = "<span style='color:black'>";
            }

            if (is_array($avar)) {
                $count = count($avar);
                echo "$indent" . ($var_name ? "$var_name => " : "") . "<span style='color:#666666'>$type ($count)</span><br>$indent(<br>";
                $keys = array_keys($avar);
                foreach ($keys as $name) {
                    $value = &$avar[$name];
                    self::doDumpX($value, "['$name']", $indent . $do_dump_indent, $reference);
                }
                echo "$indent)<br>";
            } elseif (is_object($avar)) {
                $className = get_class($avar);
                echo "$indent$var_name = <span style='color:#666666'>$type</span>( $className )";
                echo "<br>";
            } elseif (is_int($avar)) {
                echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> $type_color" . htmlentities($avar) . "</span><br>";
            } elseif (is_string($avar)) {
                echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> $type_color\"" . htmlentities($avar) . "\"</span><br>";
            } elseif (is_float($avar)) {
                echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> $type_color" . htmlentities($avar) . "</span><br>";
            } elseif (is_bool($avar)) {
                echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> $type_color" . ($avar == 1 ? "TRUE" : "FALSE") . "</span><br>";
            } elseif (is_null($avar)) {
                echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> {$type_color}NULL</span><br>";
            } else {
                echo "$indent$var_name = <span style='color:#666666'>$type(" . strlen($avar) . ")</span> " . htmlentities($avar) . "<br>";
            }

            $var = $var[$keyvar];
        }

        echo "</div>";
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