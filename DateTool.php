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


}