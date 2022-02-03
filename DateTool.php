<?php


namespace Ling\Bat;


/**
 * The DateTool class.
 */
class DateTool
{


    // https://stackoverflow.com/questions/3207749/i-have-2-dates-in-php-how-can-i-run-a-foreach-loop-to-go-through-all-of-those-d
    public static function foreachDateRange($dateStart, $dateEnd, callable $cb, $includeDateEnd = true)
    {

        if (true === $includeDateEnd) {
            $dateEnd = date("Y-m-d", strtotime($dateEnd) + 86400);
        }

        $begin = new \DateTime($dateStart);
        $end = new \DateTime($dateEnd);


        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);

        foreach ($period as $dt) {
            call_user_func($cb, $dt->format("Y-m-d"));
        }

    }


    public static function getDate($dateString)
    {
        return date('Y-m-d', strtotime($dateString));
    }


    /**
     * Returns the mysql date time corresponding to the given date.
     *
     * If the given date is null, the current datetime (of the server) will be returned.
     *
     *
     * @param string|null $iso8601Date
     * @return false|string
     */
    public static function getMysqlDatetime(string $iso8601Date = null)
    {
        if (null === $iso8601Date) {
            return date("Y-m-d H:i:s");
        }
        return date("Y-m-d H:i:s", strtotime($iso8601Date));
    }


    /**
     *
     * Return the same day of the nth-next month.
     * If the day doesn't exist (like 30 in february for instance, or 31 in april...),
     * then the closest day is taken (i.e. the last actual day of the month).
     *
     *
     * $time = strtotime("2017-10-31");
     * for ($i = 0; $i <= 15; $i++) {
     *      $_time = getSameDayNextMonth($time, $i);
     *      echo date("Y-m-d", $_time) . '<br>';
     * }
     *
     *
     * 2017-10-31
     * 2017-11-30
     * 2017-12-31
     * 2017-01-31
     * 2017-02-28
     * 2017-03-31
     * 2017-04-30
     * 2017-05-31
     * 2017-06-30
     * 2017-07-31
     * 2017-08-31
     * 2017-09-30
     * 2018-10-31
     * 2018-11-30
     * 2018-12-31
     * 2018-01-31
     *
     */
    public static function getSameDayNextMonth($time, $numberMonthsToAdd = 1)
    {
        list($year, $month, $day) = explode('-', date("Y-m-d", $time));

        // replace the day by one temporarily (just to make sure it exists for any month
        $numberOfYearsToAdd = floor($numberMonthsToAdd / 12);
        if (($month + $numberMonthsToAdd) > 12) {
            $numberOfYearsToAdd++;
        }
        $year += $numberOfYearsToAdd;
        $month = ($month + $numberMonthsToAdd) % 12;
        if (0 === $month) {
            $month = 12;
        }


        $monthFormatted = sprintf('%02s', $month);
        $nbDaysInThisMonth = date("t", strtotime("$year-$monthFormatted-01"));

        if ((int)$day > $nbDaysInThisMonth) {
            $day = $nbDaysInThisMonth;
        }


        $day = sprintf('%02s', $day);
        return strtotime("$year-$monthFormatted-$day");
    }


    /**
     * Get the time elapsed since a past event which datetime is given.
     *
     * For instance:
     *      - 2 seconds ago
     *      - 3 minutes (full=false)
     *      - 3 minutes 4 seconds ago (full=true)
     *      - 1 year 5 months 2 weeks 2 days 4 hours 50 minutes 4 seconds ago (full=true)
     *
     *
     * @param string $datetime
     * @param array $options
     *      - lang: string (eng|fra), the prebuilt lang to use. The default is eng.
     *              To create your own language, just override scale
     *      - full: bool=false, whether to display all components of the elapsed string, or just the most X relevant,
     *              X being defined by the notFullLength option.
     *      - notFullLength: int=1. If full is false, how many components should we display?
     *      - sep: string=",". The separator between components.
     *      - justNow: string. The string to display if the datetime just happened. The default in english is "just now".
     *      - format: string. The format of the returned string. The default in english is "%s ago".
     *              The %s is replaced with the computed elapsed string.
     *      - scale: array. The translation for individual components. Each component is given in singular form and plural form.
     *              Note: this is a very basic method, and the plural rule used by this method is:
     *                  if the number is more than 1, the plural form is used, otherwise the singular form is used.
     *              If the language has a more complicated plural system, then you need to use another method.
     *
     *
     *
     * @return mixed|string
     * @throws \Exception
     */
    public static function getTimeElapsedString(string $datetime, array $options = [])
    {

        $lang = $options['lang'] ?? "eng";
        $full = $options['full'] ?? false;
        $notFullLength = $options['notFullLength'] ?? 1;
        $sep = $options['sep'] ?? ", ";


        if ("fra" === $lang) {
            $justNow = $options['justNow'] ?? "à l'instant";
            $format = $options['format'] ?? "il y a %s";
            $scale = $options['scale'] ?? [
                    'y' => ['an', 'ans'],
                    'm' => ['mois', 'mois'],
                    'w' => ['semaine', 'semaines'],
                    'd' => ['jour', 'jours'],
                    'h' => ['heure', 'heures'],
                    'i' => ['minute', 'minutes'],
                    's' => ['seconde', 'secondes'],
                ];
        } else {
            $justNow = $options['justNow'] ?? "just now";
            $format = $options['format'] ?? "%s ago";
            $scale = $options['scale'] ?? [
                    'y' => ['year', 'years'],
                    'm' => ['month', 'months'],
                    'w' => ['week', 'weeks'],
                    'd' => ['day', 'days'],
                    'h' => ['hour', 'hours'],
                    'i' => ['minute', 'minutes'],
                    's' => ['second', 'seconds'],
                ];
        }


        $now = new \DateTime();
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        foreach ($scale as $k => $v) {
            if ($diff->$k) {
                $number = $diff->$k;
                $unit = ($number > 1 ? $scale[$k][1] : $scale[$k][0]);
                $scale[$k] = $number . ' ' . $unit;
            } else {
                unset($scale[$k]);
            }
        }

        if (!$full) $scale = array_slice($scale, 0, $notFullLength);
        return $scale ? sprintf($format, implode($sep, $scale)) : $justNow;
    }


    /**
     * Returns whether the datetime1 is exactly one day before datetime2.
     *
     * Datetime 1 and 2 are given in mysql datetime format (yyyy-mm-dd hh:ii:ss)
     *
     *
     *
     * @param string $datetime1
     * @param string $datetime2
     * @return bool
     */
    public static function isNextDay(string $datetime1, string $datetime2): bool
    {

        /**
         * Note: I did compare strotime+86400 at first, but for some reason it returned false between
         * 27 mars 2021 and 28 mars 2021, so it was unreliable. Also had problems with 30-31 october.
         *
         *
         * https://stackoverflow.com/questions/5883571/get-next-and-previous-day-with-php
         * So below is the only method I found was working.
         *
         */
        $newDateTime1 = self::getNextDayByDatetime($datetime1);
        return $datetime2 === $newDateTime1;

    }


    /**
     * Returns the mysql date corresponding to the day after the given date.
     *
     * @param string $date
     * @return string
     */
    public static function getNextDayByDate(string $date): string
    {
        return date("Y-m-d", strtotime('+1 day', strtotime($date)));
    }


    /**
     * Returns the mysql datetime corresponding to the day after the given datetime.
     *
     * @param string $datetime
     * @return string
     */
    public static function getNextDayByDatetime(string $datetime): string
    {
        return date("Y-m-d H:i:s", strtotime('+1 day', strtotime($datetime)));
    }

}