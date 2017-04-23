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
$content = ClassTool::getMethodContent(LayoutServices::class, 'displayLeftMenuBlocks');
a($content);
``` 



getMethodSignature
-----------
2016-12-22



```php
str    getMethodSignature ( \ReflectionMethod:method )
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


getShortName
-----------
2017-04-23



```php
str    getShortName ( object:object )
```

Return the short name for the given class.

For instance if the class is A\B\CCC,
it returns CCC.





rewriteMethodContent
-----------
2016-12-25



```php
void    rewriteMethodContent ( string:class, string:method, callable:func )
```

Rewrites the file containing the given class and method, after updating its content.

The content can be modified using the third argument, a callable which accepts one argument: lines.

lines is an array which contains the lines inside the target method.

lines is passed as a reference to the transformer callback.

 
```php
<?php


use Bat\ClassTool;

require_once "bigbang.php";


class POOO
{


    public static function reindeer($someParams)
    {
        $doo = 6;
        return $doo;
    }

    public static function dormir(){
        return "pou";
    }

}


ClassTool::rewriteMethodContent('POOO', 'reindeer', function (&$lines) {
    array_splice($lines, 1, 0, '$doo += 9;');
});

```
 
 After executing this code, the file will look like this:



```php
<?php


use Bat\ClassTool;

require_once "bigbang.php";


class POOO
{


    public static function reindeer($someParams)
    {
        $doo = 6;
        $doo += 9;
        return $doo;
    }

    public static function dormir(){
        return "pou";
    }

}


ClassTool::rewriteMethodContent('POOO', 'reindeer', function (&$lines) {
    array_splice($lines, 1, 0, '$doo += 9;');
});

```
