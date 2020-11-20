DebugTool
=====================
2018-02-26 -> 2020-11-20



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



dumpX
-------------
2019-09-17


```php
void dumpX ( ...args )
```

Prints a dump for every arguments passed to it, and exits.
Objects are printed as class name to avoid too long to read dumps.

Note: this method should be used in a web environment (i.e. no cli implementation yet).


### Example:
```php

DebugTool::dumpX($installItems, "iii", true, 987, $light);

```


Will output something like this:

```html

Array (2)
(
|    ['0'] => Array (2)
|    (
|    |    ['0'] = Object( Ling\Light_Kit_Admin\Service\LightKitAdminService )
|    |    ['1'] = String(18) "Light_UserDatabase"
|    )
|    ['1'] => Array (2)
|    (
|    |    ['0'] = Object( Ling\Light_UserDatabase\MysqlLightWebsiteUserDatabase )
|    |    ['1'] = NULL(0) NULL
|    )
)
= String(3) "iii"
= Boolean(1) TRUE
= Integer(3) 987
= Object( Ling\Light\Core\Light )
```






getArrayPartial
-------------
2018-05-24


```php
array getArrayPartial ( array:arr, array:options=[] )
```

Return a filtered array.
Possible filters are:

- include: array of bdot paths to include, all other entries will be removed (i.e. only the paths that you specified will be included in the returned result)
- exclude: array of bdot paths to exclude)

Only one filter type can be used at the time (i.e. either include or exclude, but not both at the same time)

### Example:
```php


// Note that in this example, I use two filters at the same time (just to give you an overview of what's possible),
// in such a case, only the include will be considered.


az(DebugTool::getArrayPartial($_SESSION, [
    "include" => [
        "ekom.currentCheckoutData",
        "ekom.estimateCurrentCheckoutData",
    ],
    "exclude" => [
        "ekom",
        "nullos.user.login",
    ],
]));
```


getTraceAsString
-----------
2020-11-20


```php
string getTraceAsString ( array:options=[] )
```


Returns a debug_backtrace like string.

Available options are:

- skip: int=0, how many lines to drop from the beginning.
- strMaxLen: int=null, if an argument is of type string how many chars max to display.
     If null, all the chars are displayed.
     
     
    
toString
-------------
2018-02-26 -> 2020-11-20


```php
string toString ( mixed:thing, array:options=[] )
```

Return a string representation of the given thing.

Available options are:

- expandArray: bool=true. Whether to display the content of the arrays. If false, the word "array" will be used instead.
- strMaxLen: int=null, if the thing is of type string how many chars max to display.
     If null, all the chars are displayed.
- strCompact: bool = false. If true and type is string, reduce all long white spaces to one space, and returns the trimmed result.


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