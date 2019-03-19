[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\DateTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool.md)


DateTool::getSameDayNextMonth
================



DateTool::getSameDayNextMonth — Return the same day of the nth-next month.




Description
================


public static [DateTool::getSameDayNextMonth](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getSameDayNextMonth.md)(?$time, $numberMonthsToAdd = 1) : void




Return the same day of the nth-next month.
If the day doesn't exist (like 30 in february for instance, or 31 in april...),
then the closest day is taken (i.e. the last actual day of the month).


$time = strtotime("2017-10-31");
for ($i = 0; $i <= 15; $i++) {
$_time = getSameDayNextMonth($time, $i);
echo date("Y-m-d", $_time) . '<br>';
}


2017-10-31
2017-11-30
2017-12-31
2017-01-31
2017-02-28
2017-03-31
2017-04-30
2017-05-31
2017-06-30
2017-07-31
2017-08-31
2017-09-30
2018-10-31
2018-11-30
2018-12-31
2018-01-31




Parameters
================



Return values
================

Returns void.








See Also
================

The [DateTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool.md) class.

Previous method: [getMysqlDatetime](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getMysqlDatetime.md)<br>Next method: [getTimeElapsedString](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getTimeElapsedString.md)<br>

