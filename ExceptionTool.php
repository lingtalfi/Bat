<?php

namespace Bat;

/*
 * LingTalfi 2016-01-16
 */
class ExceptionTool
{


    /**
     * Equivalent of the php's native __toString method,
     * but the trace shows all characters (php's default trace trims long lines)
     *
     * @return string
     */
    public static function toString(\Exception $e)
    {

        return "exception '" . get_class($e) . "' with message '" . $e->getMessage() . "' in " . $e->getFile() . ":" . $e->getLine() . PHP_EOL .
        'Stack trace:' . PHP_EOL .
        self::traceAsString($e);
    }


    /**
     * Return the traceAsString, but with all characters (not trimmed like native php's getTraceAsString do).
     * http://stackoverflow.com/questions/1949345/how-can-i-get-the-full-string-of-php-s-gettraceasstring
     *
     * @return string
     */
    public static function traceAsString(\Exception $exception)
    {
        $rtn = "";
        $count = 0;
        foreach ($exception->getTrace() as $frame) {
            $args = "";
            if (isset($frame['args'])) {
                $args = array();
                foreach ($frame['args'] as $arg) {
                    if (is_string($arg)) {
                        $args[] = "'" . $arg . "'";
                    }
                    elseif (is_array($arg)) {
                        $args[] = "Array";
                    }
                    elseif (is_null($arg)) {
                        $args[] = 'NULL';
                    }
                    elseif (is_bool($arg)) {
                        $args[] = ($arg) ? "true" : "false";
                    }
                    elseif (is_object($arg)) {
                        $args[] = get_class($arg);
                    }
                    elseif (is_resource($arg)) {
                        $args[] = get_resource_type($arg);
                    }
                    else {
                        $args[] = $arg;
                    }
                }
                $args = join(", ", $args);
            }
            $rtn .= sprintf("#%s %s(%s): %s(%s)\n",
                $count,
                isset($frame['file']) ? $frame['file'] : 'unknown file',
                isset($frame['line']) ? $frame['line'] : 'unknown line',
                (isset($frame['class'])) ? $frame['class'] . $frame['type'] . $frame['function'] : $frame['function'],
                $args);
            $count++;
        }
        $rtn .= '#' . $count . ' {main}';
        return $rtn;
    }

}
