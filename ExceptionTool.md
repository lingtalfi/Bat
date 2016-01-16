ExceptionTool
=====================
2016-01-16



This class contains functions for manipulating exceptions.



Note: 
some examples use the a function, which comes from the [bigbang technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md ).
If you don't use bigbang, you can use var_dump as a replacement.




toString
-------------
2016-01-16


```php
string    toString ( \Exception:e )
```

Equivalent of the php's native __toString method, but the trace shows all characters (php's default trace trims long lines)


Example:

```php
<?php


use Bat\ExceptionTool;

require_once "bigbang.php"; // start the local universe


function zz()
{
    $e = new \Exception("ooo");
    a(ExceptionTool::toString($e));
}


zz();

```

The output will look like this:

```html 
string 'exception 'Exception' with message 'ooo' in /Volumes/Macintosh HD 2/it/php/projects/universe/www/sandbox-pretest.php:11
Stack trace:
#0 /Volumes/Macintosh HD 2/it/php/projects/universe/www/sandbox-pretest.php(16): zz()
#1 {main}' (length=228)

```




traceAsString
-------------
2016-01-16


```php
string    traceAsString ( \Exception:e )
```

Return the traceAsString, but with all characters (not trimmed like native php's getTraceAsString do).

