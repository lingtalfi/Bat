<?php

namespace Ling\Bat;


/**
 * The StopWatchTool class.
 * A quick stopwatch tool to measure a single operation.
 */
class StopWatchTool
{


    /**
     * This property holds the start for this instance.
     * @var int
     */
    private static int $start = 0;



    /**
     * Starts the stopwatch.
     */
    public static function start()
    {
        self::$start = hrtime(true);
    }


    /**
     * Stops the stopwatch and returns the elapsed time from the start in the given format (nanoseconds by default).
     * Available formats are:
     * - s: seconds
     * - m: micro-seconds
     * - n: nano-seconds
     *
     *
     *
     *
     * @return float
     */
    public static function stop(string $format = "n"): float
    {
        $t = hrtime(true);
        $ret =  $t - self::$start;

        if('s' === $format){
            $ret = $ret / 1000000000;
        }
        elseif('m' === $format){
            $ret = $ret / 1000000;
        }
        return $ret;
    }
}
