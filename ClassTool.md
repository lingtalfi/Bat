ClassTool
=====================
2016-12-22



This class contains functions for helping with classes.



getMethodContent
-----------
2016-12-22



```php
str    getMethodContent ( string:class, string:method )
```

Gets the code of the given method, from the start line
to the end line (including the signature).

 
```php
$content = ClassTool::getMethodContent(LayoutBridge::class, 'displayLeftMenuBlocks');
a($content);
``` 



getMethodSignature
-----------
2016-12-22



```php
str    getMethodSignature ( \ReflectionMethod::method )
```

Gets the signature of a given method.

 
```php
<?php


use Bat\ClassTool;
use DirScanner\DirScanner;

require_once "bigbang.php";


class A
{
    public static function pou(array &$daa, DirScanner $po, $pp = 6, \Closure $func)
    {
        return 6;
    }
}


$method = new \ReflectionMethod('A', 'pou');
a(ClassTool::getMethodSignature($method)); // public static function pou(array &$daa, \DirScanner\DirScanner $po, $pp, \Closure $func)
``` 




