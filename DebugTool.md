DebugTool
=====================
2018-02-26



This class contains functions for debugging.





    
dump
-------------
2018-03-22


```php
string dump ( mixed:thing)
```

Prints a var dump representation of the given thing.
This is actually the oop equivalent of the universe "a" debug function.


### Example:
```php

DebugTool::dump($thing);
```



dumpVar
-------------
2018-05-22


```php
string dumpVar ( mixed:thing, bool:return=true  )
```

Return or print a var dump representation of the given thing.
This is actually the oop equivalent of the universe "a" debug function.


### Example:
```php

$dump = DebugTool::dumpVar($thing);
```



    
toString
-------------
2018-02-26


```php
string toString ( mixed:thing)
```

Return a string representation of the given thing.


### Example:
```php


/**
 * [
 * 'joo' => 5,
 * ]
 */
$thing = function ($var) { // closure($var)
    return $var;
};
$thing = "substr"; // callable(substr)
$thing = ["joo" => 5];
$thing = "goo"; // goo
$thing = new DebugTool(); // object(Bat\DebugTool)
$thing = [new DebugTool(), "toString"]; // callable(Bat\DebugTool::toString($thing))

az(DebugTool::toString($thing));
```