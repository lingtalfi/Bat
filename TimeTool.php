<?php


namespace Ling\Bat;


use DateTime;
use Ling\Bat\Exception\BatException;

/**
 * The TimeTool class.
 *
 * With this class, the word "iso time" refers to hh:mm:ss (iso8601 default time format)
 *
 * The word "time" refers to a more flexible time, which can be one of those:
 * - s
 * - ss
 * - m:ss
 * - mm:ss
 * - h:mm:ss
 * - hh:mm:ss
 *
 *
 */
class TimeTool
{


    /**
     * Returns the "iso time" from the given times.
     *
     * Note: time2 must be greater than time1, otherwise the results are unpredictable.
     *
     * See nomenclature at the top of this class.
     *
     *
     * @param string $time1
     * @param string $time2
     * @return string
     */
    public static function getTimeDiff(string $time1, string $time2): string
    {

        $isoTime1 = self::getIsoTime($time1);
        $isoTime2 = self::getIsoTime($time2);


        $datetime1 = new DateTime('2020-01-01 ' . $isoTime1);
        $datetime2 = new DateTime('2020-01-01 ' . $isoTime2);

        $seconds = $datetime2->getTimestamp() - $datetime1->getTimestamp();
        $hours = floor($seconds / 3600);
        $mins = floor($seconds / 60 % 60);
        $secs = floor($seconds % 60);
        return sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    }


    /**
     * Returns the "iso time" from the given "time".
     *
     * See nomenclature at the top of this class.
     *
     * @param string $time
     * @return string
     */
    public static function getIsoTime(string $time): string
    {
        $p = explode(':', $time);
        $nbComponents = count($p);
        if ($nbComponents > 3) {
            throw new BatException("This is not a valid \"time\", see our time definition in the TimeTool class.");
        }

        $hours = 0;
        $minutes = 0;
        $seconds = 0;

        if (3 === $nbComponents) {
            list($hours, $minutes, $seconds) = $p;
        } elseif (2 === $nbComponents) {
            list($minutes, $seconds) = $p;
        } elseif (1 === $nbComponents) {
            list($seconds) = $p;
        }

        $hours = (int)$hours;
        $minutes = (int)$minutes;
        $seconds = (int)$seconds;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    }

}