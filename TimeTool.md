TimeTool
=====================
2020-07-24



This class contains functions for manipulating time.



Iso time and time definitions
---------
2020-07-04


With this class, the word "iso time" refers to hh:mm:ss (iso8601 default time format)

The word "time" refers to a more flexible time, which can be one of those:
- s
- ss
- m:ss
- mm:ss
- h:mm:ss
- hh:mm:ss







getIsoTime
-------------
2020-07-24


```getIsoTime(string $time): string```



Returns the "iso time" from the given "time".

See nomenclature at the top of this class.




### Example


```php
<?php

a(TimeTool::getIsoTime("0"));           // 00:00:00
a(TimeTool::getIsoTime("5"));           // 00:00:05
a(TimeTool::getIsoTime("05"));          // 00:00:05
a(TimeTool::getIsoTime("1:05"));        // 00:01:05
a(TimeTool::getIsoTime("21:05"));       // 00:21:05
a(TimeTool::getIsoTime("1:21:05"));     // 01:21:05
a(TimeTool::getIsoTime("21:21:05"));    // 21:21:05
```







getTimeDiff
-------------
2020-07-24


```getTimeDiff(string $time1, string $time2): string```


Returns the "iso time" from the given times.

Note: time2 must be greater than time1, otherwise the results are unpredictable.

See nomenclature at the top of this class.




### Example


```php
<?php

a(TimeTool::getTimeDiff("26", "28"));           // 00:00:02
a(TimeTool::getTimeDiff("26", "1:28"));         // 00:01:02
a(TimeTool::getTimeDiff("26", "21:28"));        // 00:21:02
a(TimeTool::getTimeDiff("2:28", "21:28"));      // 00:19:00
a(TimeTool::getTimeDiff("2:28", "1:21:28"));    // 01:19:00
```

