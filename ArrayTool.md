ArrayTool
=====================
2015-12-20



This class contains functions for manipulating arrays.



Note: 
some examples use the a function, which comes from the [bigbang technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md ).
If you don't use bigbang, you can use var_dump as a replacement.



arrayKeyExistAll
-------------
2018-01-18


```php
array    arrayKeyExistAll ( array:keys, array:pool)
```

Returns whether or not ALL the keys are keys of pool.


### Example

```php
<?php

$keys = ['a', 'b', 'c'];
$pool = ['a', 'd'];

a(ArrayTool::arrayKeyExistAll($keys, $pool)); // false



```

  
    
arrayUniqueRecursive
-------------
2017-05-04


```php
array    arrayUniqueRecursive ( array:arr)
```

Returns an array after applying the "unique" filter recursively to it.


### Example

```php
<?php

$input = array_merge_recursive($profile1, $profile2);
$input = Bat::arrayUniqueRecursive($input);

```
     

    
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
     
     
    
mirrorRange
-------------
2017-10-30


```php
array    mirrorRange ( mixed:start, mixed:end, mixed:step = 1 )
```


Like php range function, but the ranges applies on both the values and the keys
(i.e. not just the values like the php range function does).



```php
<?php

az(ArrayTool::mirrorRange(1,10));

/**
 * Displays this:
 * 
 * array(10) {
 *   [1] => int(1)
 *   [2] => int(2)
 *   [3] => int(3)
 *   [4] => int(4)
 *   [5] => int(5)
 *   [6] => int(6)
 *   [7] => int(7)
 *   [8] => int(8)
 *   [9] => int(9)
 *   [10] => int(10)
 * }
*/

```
     
    
removeEntry
-------------
2018-02-16


```php
void removeEntry ( mixed:entry, array:&$arr)
```


remove the entry from the array.



```php
<?php

$arr = ["red", "blue", "green"];
ArrayTool::removeEntry("blue", $arr);
a($arr);

/**
 * Displays this:
 * 
 * array(2) {
 *      [0] => string(3) "red"
 *      [2] => string(5) "green"
 * }
*/

```
     
     
     
superimpose
--------------
2017-06-08
     

```php
array    superimpose(array layer, array base)
```

Put the layer array on top of the base array,
and return an array containing only the base keys,
which values are replaced by the layer values if available.



### Example

```php
<?php


$replace =  [
    "aoo" => 6,
    "doo" => 67,
    "coo" => 68,
];

$base = [
    "aoo" => 78,
    "boo" => 78,
];

$result = ArrayTool::superimpose($replace, $base);
a($result);

/**
 * Returns the following 
 * 
* array(2) {
*    ["aoo"] => int(6)
*    ["boo"] => int(78)
*  }
*/

```     
     
     

