[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\DateTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool.md)


DateTool::getTimeElapsedString
================



DateTool::getTimeElapsedString — Get the time elapsed since a past event which datetime is given.




Description
================


public static [DateTool::getTimeElapsedString](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getTimeElapsedString.md)(string $datetime, array $options = []) : mixed | string




Get the time elapsed since a past event which datetime is given.
For instance:
- 2 seconds ago
- 3 minutes (full=false)
- 3 minutes 4 seconds ago (full=true)
- 1 year 5 months 2 weeks 2 days 4 hours 50 minutes 4 seconds ago (full=true)




Parameters
================


- datetime

    

- options

    


Return values
================

Returns mixed | string.


Exceptions thrown
================

- [Exception](http://php.net/manual/en/class.exception.php).&nbsp;







See Also
================

The [DateTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool.md) class.

Previous method: [getSameDayNextMonth](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/DateTool/getSameDayNextMonth.md)<br>

