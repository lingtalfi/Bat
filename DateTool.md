DateTool
=====================
2017-11-28



This class contains functions for helping with dates.



getSameDayNextMonth
-----------
2017-11-28



```php
int:time     getSameDayNextMonth ( int:time, int:numberMonthsToAdd = 1 )
```

Return the same day of the nth-next month.
If the day doesn't exist (like 30 in february for instance, or 31 in april...),
then the closest day is taken (i.e. the last actual day of the month).

 
```php
$time = strtotime("2017-10-31");
for ($i = 0; $i <= 15; $i++) {
    $_time = DateTool::getSameDayNextMonth($time, $i);
    echo date("Y-m-d", $_time) . '<br>';
}

/**
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
 */
``` 

