StopWatchTool
=====================
2021-07-17



This class contains stopwatch related methods.



start
---------
2021-07-17


```php 
public static function start()
```

Starts the stopwatch.


stop
---------
2021-07-17




```php 
public static function stop(string $format = "n"): float
```

Stops the stopwatch and returns the elapsed time from the start in the given format (nanoseconds by default).
Available formats are:
- s: seconds
- m: micro-seconds
- n: nano-seconds


Example: 

```php 
StopWatchTool::start();
sleep(1);
az(StopWatchTool::stop()); // float(1075102879)

```

