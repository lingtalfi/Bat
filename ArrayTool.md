ArrayTool
=====================
2015-12-20



This class contains functions for manipulating arrays.



Note: 
some examples use the a function, which comes from the [bigbang technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md ).
If you don't use bigbang, you can use var_dump as a replacement.




    
getMissingKeys
-------------
2015-12-20


```php
array|false    getMissingKeys ( array:arr, array:keys )
```

Check that all given $keys exist (as keys) in the given $arr.
If not, returns the missing keys.


### Example

```php
<?php


use Bat\ArrayTool;

require_once "bigbang.php";



$arr = [
    "firstName" => 'peter',
    "lastName" => 'Parker',
    "job" => 'spiderman',
];

a(ArrayTool::getMissingKeys($arr, ['firstName', 'powers', 'girlFriend']));  // [powers, girlFriend]   
a(ArrayTool::getMissingKeys($arr, ['firstName', 'lastName']));  // false 


```
     

