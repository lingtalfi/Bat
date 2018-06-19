<?php


namespace Bat;


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


    public static function getMysqlDatetime(string $iso8601Date)
    {
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
     * For instance:
     *      - 2 seconds ago
     *      - 3 minutes (full=false)
     *      - 3 minutes 4 seconds ago (full=true)
     *      - 1 year 5 months 2 weeks 2 days 4 hours 50 minutes 4 seconds ago (full=true)
     *
     *
     * @param string $datetime
     * @param array $options
     * @return mixed|string
     */
    public static function getTimeElapsedString(string $datetime, array $options = [])
    {

        $lang = $options['lang'] ?? "eng";
        $full = $options['full'] ?? false;
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

        if (!$full) $scale = array_slice($scale, 0, 1);
        return $scale ? sprintf($format, implode($sep, $scale)) : $justNow;
    }

}