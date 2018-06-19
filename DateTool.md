DateTool
=====================
2017-11-28



This class contains functions for helping with dates.




foreachDateRange
-----------
2018-02-28


```php
void     foreachDateRange ( str:dateStart, str:dateEnd, callable:cb, bool:includeDateEnd=true)
```

Loops from dateStart to dateEnd included/excluded, depending on the includedDateEnd flag.

Note: dateStart and dateEnd are in the mysql date format (yyyy-mm-dd)
 
 
 

getDate
-----------
2018-02-28


```php
str:mysqlDate     getDate ( str:dateString)
```

Return the (mysql) date from the dateString (which is a date-ish string)

 
```php
a(DateTool::getDate("2018-02-28 00:56:45")); // 2018-02-28
``` 




getMysqlDatetime
-----------
2018-06-17


```php
str:mysqlDatetime     getMysqlDatetime ( str:dateString)
```

Return the mysql datetime from the dateString (which is a date-ish string)


```php
az(DateTool::getMysqlDatetime("2018-06-17T14:28:43+02:00")); // 2018-06-17 14:28:43
```




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


getTimeElapsedString
-----------
2018-06-19



```php
str:timeElapsed     getTimeElapsedString ( str:datetime, array:options=[] )
```

Get the time elapsed since a past event which datetime is given.
For instance:
- 2 seconds ago
- 3 minutes (full=false)
- 3 minutes 4 seconds ago (full=true)
- 1 year 5 months 2 weeks 2 days 4 hours 50 minutes 4 seconds ago (full=true)

 
```php
a(DateTool::getTimeElapsedString("2018-03-12 05:45:12")); // 3 months ago
a(DateTool::getTimeElapsedString("2018-03-12 05:45:12", [
    "full" => true,
])); // 3 months, 1 week, 7 hours, 30 minutes, 58 seconds ago
a(DateTool::getTimeElapsedString("2018-03-12 05:45:12", [
    "full" => true,
    "format" => "il y a %s",
    "justNow" => "à l'instant",
    "scale" => [
        'y' => ['an', 'ans'],
        'm' => ['mois', 'mois'],
        'w' => ['semaine', 'semaines'],
        'd' => ['jour', 'jours'],
        'h' => ['heure', 'heures'],
        'i' => ['minute', 'minutes'],
        's' => ['seconde', 'secondes'],
    ],
])); // il y a 3 mois, 1 semaine, 7 heures, 32 minutes, 18 secondes

a(DateTool::getTimeElapsedString("2018-03-12 05:45:12", [
    "full" => true,
    "lang" => "fra",
])); // il y a 3 mois, 1 semaine, 7 heures, 32 minutes, 18 secondes


a(DateTool::getTimeElapsedString(date("Y-m-d H:i:s"), [
    "full" => true,
    "lang" => "fra",
])); // à l'instant
``` 

