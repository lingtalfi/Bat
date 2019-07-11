datetool
=====================
2017-11-28



this class contains functions for helping with dates.




foreachdaterange
-----------
2018-02-28


```php
void     foreachdaterange ( str:datestart, str:dateend, callable:cb, bool:includedateend=true)
```

loops from datestart to dateend included/excluded, depending on the includeddateend flag.

note: datestart and dateend are in the mysql date format (yyyy-mm-dd)
 
 
 

getdate
-----------
2018-02-28


```php
str:mysqldate     getdate ( str:datestring)
```

return the (mysql) date from the datestring (which is a date-ish string)

 
```php
a(datetool::getdate("2018-02-28 00:56:45")); // 2018-02-28
``` 




getmysqldatetime
-----------
2018-06-17


```php
str:mysqldatetime     getmysqldatetime ( str:datestring)
```

return the mysql datetime from the datestring (which is a date-ish string)


```php
az(datetool::getmysqldatetime("2018-06-17t14:28:43+02:00")); // 2018-06-17 14:28:43
```




getsamedaynextmonth
-----------
2017-11-28



```php
int:time     getsamedaynextmonth ( int:time, int:numbermonthstoadd = 1 )
```

return the same day of the nth-next month.
if the day doesn't exist (like 30 in february for instance, or 31 in april...),
then the closest day is taken (i.e. the last actual day of the month).

 
```php
$time = strtotime("2017-10-31");
for ($i = 0; $i <= 15; $i++) {
    $_time = datetool::getsamedaynextmonth($time, $i);
    echo date("y-m-d", $_time) . '<br>';
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


gettimeelapsedstring
-----------
2018-06-19 -> 2019-07-11



```php
str:timeelapsed     gettimeelapsedstring ( str:datetime, array:options=[] )
```

get the time elapsed since a past event which datetime is given.
for instance:
- 2 seconds ago
- 3 minutes (full=false)
- 3 minutes 4 seconds ago (full=true)
- 1 year 5 months 2 weeks 2 days 4 hours 50 minutes 4 seconds ago (full=true)

 
Options: 
 
- lang: string (eng|fra), the prebuilt lang to use. the default is eng.
       to create your own language, just override scale
- full: bool=false, whether to display all components of the elapsed string, or just the most x relevant,
       x being defined by the notfulllength option.
- notfulllength: int=1. if full is false, how many components should we display?
- sep: string=",". the separator between components.
- justnow: string. the string to display if the datetime just happened. the default in english is "just now".
- format: string. the format of the returned string. the default in english is "%s ago".
       the %s is replaced with the computed elapsed string.
- scale: array. the translation for individual components. each component is given in singular form and plural form.
       note: this is a very basic method, and the plural rule used by this method is:
           if the number is more than 1, the plural form is used, otherwise the singular form is used.
       if the language has a more complicated plural system, then you need to use another method.
      
 
```php
a(datetool::gettimeelapsedstring("2018-03-12 05:45:12")); // 3 months ago
a(datetool::gettimeelapsedstring("2018-03-12 05:45:12", [
    "full" => true,
])); // 3 months, 1 week, 7 hours, 30 minutes, 58 seconds ago
a(datetool::gettimeelapsedstring("2018-03-12 05:45:12", [
    "full" => true,
    "format" => "il y a %s",
    "justnow" => "à l'instant",
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

a(datetool::gettimeelapsedstring("2018-03-12 05:45:12", [
    "full" => true,
    "lang" => "fra",
])); // il y a 3 mois, 1 semaine, 7 heures, 32 minutes, 18 secondes


a(datetool::gettimeelapsedstring(date("y-m-d h:i:s"), [
    "full" => true,
    "lang" => "fra",
])); // à l'instant
``` 

