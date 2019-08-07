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



arrayMergeReplaceRecursive
-------------
2019-01-17


```php
array    arrayMergeReplaceRecursive ( array:arrays)
```


Merge the given arrays and return a resulting array,
appending numeric keys, and replacing existing associative keys.


The merging rules are basically the following:
- set the associative key only if it doesn't already exist
- if it's a numeric key, append it


### Example:

Given array1:

```txt
array(1) {
     ["example"] => array(2) {
         ["fruits"] => array(2) {
             [0] => string(5) "apple"
             [1] => string(6) "banana"
         }
         ["numbers"] => array(2) {
             ["one"] => int(1)
             ["two"] => int(2)
         }
     }
}
```


and array2:


```txt
array(1) {
     ["example"] => array(3) {
         ["fruits"] => array(1) {
             [0] => string(6) "cherry"
         }
         ["sports"] => array(2) {
             [0] => string(4) "judo"
             [1] => string(6) "karate"
         }
         ["numbers"] => array(1) {
             ["two"] => int(222)
         }
     }
}
```


The result of Bat::arrayMergeReplaceRecursive([array1, array2]) gives:


```txt
array(1) {
     ["example"] => array(3) {
         ["fruits"] => array(3) {
             [0] => string(5) "apple"
             [1] => string(6) "banana"
             [2] => string(6) "cherry"
         }
         ["numbers"] => array(2) {
             ["one"] => int(1)
             ["two"] => int(222)
         }
         ["sports"] => array(2) {
             [0] => string(4) "judo"
             [1] => string(6) "karate"
         }
     }
}
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
     
     
     
filterByAllowed
-------------
2019-08-07     


```php
array    filterByAllowed ( array:arr, array:allowed)
```

Returns the "arr" array, without the entries which keys are NOT listed in "allowed".




### Example

```php
$array = [
    "one" => 11,
    "two" => 22,
    "garbage" => 123,
];

$allowed = ["one", "two"];

az(ArrayTool::filterByAllowed($array, $allowed));
```

This will output:

```html
array(2) {
  ["one"] => int(11)
  ["two"] => int(22)
}

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


use Ling\Bat\ArrayTool;

require_once "bigbang.php";



$arr = [
    "firstName" => 'peter',
    "lastName" => 'Parker',
    "job" => 'spiderman',
];

a(ArrayTool::getMissingKeys($arr, ['firstName', 'powers', 'girlFriend']));  // [powers, girlFriend]   
a(ArrayTool::getMissingKeys($arr, ['firstName', 'lastName']));  // false 


```


    
insertRowAfter
-------------
2018-04-30


```php
void    insertRowAfter ( int:index, array:row, array:&rows )
```

Insert the given row into the rows.


### Example

```php
<?php 

$arr = [
    [
        "name" => "peter",
        "age" => "46",
    ],
    [
        "name" => "andrea",
        "age" => "28",
    ],
    [
        "name" => "fabrizzio",
        "age" => "13",
    ],
];

ArrayTool::insertRowAfter(1, [
    "name" => "mélanie",
    "age" => "5",
], $arr);


a($arr); // melanie is now after andrea...

```

    
isNumericalArray
-------------
2019-07-17


```php
void    isNumericalArray ( mixed:array, bool:emptyIsValid=true )
```

Returns whether the given argument is an array which first key is numerical.

Note: supposedly if the first key is numerical, chances are that the whole array is numerical,
depending on the array structure. This method was designed to give a quick guess, as opposed to
check all the keys of the array, which might take too long depending on the array size.



### Example

```php
<?php 

$arr = ["a", "b" , "c"];
a(ArrayTool::isNumericalArray($arr)); // true
$arr = ["pou" => "a", "b" , "c"];
a(ArrayTool::isNumericalArray($arr));

```





keysSameAsValues
-------------
2018-03-25


```php
array    keysSameAsValues ( array:values )
```

Return an array with keys equal to values.


### Example

```php
<?php

$values = ["blue", "red"];
a(ArrayTool::keysSameAsValues($values));
?>
<pre>
array(2) {
  ["blue"] => string(4) "blue"
  ["red"] => string(3) "red"
}
</pre>
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


objectToArray
-------------
2019-07-13


```php
array    objectToArray ( obj object )
```


This method returns the array corresponding to an object, including non public members.


This example (using the service container from the light framework):

```php
<?php

$user = $service->get("user_manager")->getUser();
a($user);
$user = ArrayTool::objectToArray($user);
a($user);

```


displays the following output:

```html
object(Ling\Light_User\WebsiteLightUser)#157 (7) {
  ["email":"Ling\Light_User\WebsiteLightUser":private] => string(19) "lingtalfi@gmail.com"
  ["avatar_url":protected] => string(58) "/plugins/Light_Kit_Admin/zeroadmin/img/avatars/photo-1.jpg"
  ["pseudo":protected] => string(4) "Ling"
  ["connect_time":protected] => int(1562970049)
  ["last_refresh_time":protected] => int(1562970049)
  ["session_duration":protected] => int(500)
  ["rights":protected] => array(0) {
  }
}

array(7) {
  ["email"] => string(19) "lingtalfi@gmail.com"
  ["avatar_url"] => string(58) "/plugins/Light_Kit_Admin/zeroadmin/img/avatars/photo-1.jpg"
  ["pseudo"] => string(4) "Ling"
  ["connect_time"] => int(1562970049)
  ["last_refresh_time"] => int(1562970049)
  ["session_duration"] => int(500)
  ["rights"] => array(0) {
  }
}

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
     
     





updateNodeRecursive
--------------
2018-05-29
     

```php
array    updateNodeRecursive (array &$arr, callable $callback, array $options = [])
```

Update the structure of a node collection recursively.
Children nodes must be referenced directly in the nodes using the "children" key by default.


Options:
- childrenKey: string=children, the name of the key used to reference the children of a node



### Example

```php
<?php

$linkFmt = A::link("Ekom_category", [
    "type" => '{type}',
    "slug" => '{slug}',
]);

ArrayTool::updateNodeRecursive($ret, function (array &$row) use ($linkFmt) {
        $row['link'] = str_replace([
            "{type}",
            "{slug}",
        ], [
            $row['type'],
            $row['slug'],
        ], $linkFmt);
    });

```     
     
     

