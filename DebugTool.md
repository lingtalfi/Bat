DebugTool
=====================
2018-02-26



This class contains functions for debugging.





    
toString
-------------
2018-02-26


```php
string getDotValue ( mixed:thing)
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