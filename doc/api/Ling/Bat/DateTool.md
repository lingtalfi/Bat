[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)



The DateTool class
================
2019-03-19 --> 2019-03-19






Introduction
============

The DateTool class.



Class synopsis
==============


class <span class="pl-k">DateTool</span>  {

- Methods
    - public static [foreachDateRange](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/foreachDateRange.md)(?$dateStart, ?$dateEnd, callable $cb, $includeDateEnd = true) : void
    - public static [getDate](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getDate.md)(?$dateString) : void
    - public static [getMysqlDatetime](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getMysqlDatetime.md)(string $iso8601Date) : void
    - public static [getSameDayNextMonth](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getSameDayNextMonth.md)(?$time, $numberMonthsToAdd = 1) : void
    - public static [getTimeElapsedString](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getTimeElapsedString.md)(string $datetime, array $options = []) : mixed | string

}






Methods
==============

- [DateTool::foreachDateRange](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/foreachDateRange.md) &ndash; 
- [DateTool::getDate](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getDate.md) &ndash; 
- [DateTool::getMysqlDatetime](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getMysqlDatetime.md) &ndash; 
- [DateTool::getSameDayNextMonth](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getSameDayNextMonth.md) &ndash; Return the same day of the nth-next month.
- [DateTool::getTimeElapsedString](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getTimeElapsedString.md) &ndash; Get the time elapsed since a past event which datetime is given.





Location
=============
Ling\Bat\DateTool


SeeAlso
==============
Previous class: [ConvertTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConvertTool.md)<br>Next class: [DebugTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DebugTool.md)<br>
