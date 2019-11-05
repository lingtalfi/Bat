ArrayTool
=====================
2015-12-20



This class contains functions for manipulating arrays.



Note: 
some examples use the a function, which comes from the [bigbang technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md ).
If you don't use bigbang, you can use var_dump as a replacement.



Table of Contents
=================

* [arrayKeyExistAll](#arraykeyexistall)
* [arrayMergeReplaceRecursive](#arraymergereplacerecursive)
* [arrayUniqueRecursive](#arrayuniquerecursive)
* [filterByAllowed](#filterbyallowed)
* [filterRecursive](#filterrecursive)
* [getMissingKeys](#getmissingkeys)
* [insertRowAfter](#insertrowafter)
* [isNumericalArray](#isnumericalarray)
* [keysSameAsValues](#keyssameasvalues)
* [mirrorRange](#mirrorrange)
* [objectToArray](#objecttoarray)
* [reduce](#reduce)
* [removeEntry](#removeentry)
* [superimpose](#superimpose)
* [updateNodeRecursive](#updatenoderecursive)
* [walkRowsRecursive](#walkrowsrecursive)

         
         

arrayKeyExistAll
-------------
2018-01-18 -> 2019-10-31


```php
bool    arrayKeyExistAll ( mixed:keys, array:pool, bool throwEx=false)
```

Checks that every given keys exist in the given pool array, and by default
returns the result as a boolean.

If the throwEx flag is set to true, then this method throws an exception if
one key (or more) is not found.



### Example

```php
<?php

$keys = ['a', 'b', 'c'];
$pool = ['a', 'd'];

a(ArrayTool::arrayKeyExistAll($keys, $pool)); // false
a(ArrayTool::arrayKeyExistAll($keys, $pool, true)); // throws an exception



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
     
     
     
     
     
filterRecursive
-------------
2019-08-09


```php
array    filterByAllowed ( array:arr, callable:callback)
```

Filters the elements of an array recursively, using a given callable.

The callable function must return a boolean (whether to accept the value or remove it).



### Example

```php
$arr = [
    [
        "id" => "one",
        "children" => [],
    ],
    [
        "id" => "two",
        "children" => [
            [
                "id" => "three",
                "children" => [],
            ],
        ],
    ],

];
$a = ArrayTool::filterRecursive($arr, function () {
    return true;
});
$b = ArrayTool::filterRecursive($arr, function () {
    return false;
});
$c = ArrayTool::filterRecursive($arr, function ($value) {
    if (
        is_array($value) &&
        array_key_exists("id", $value) &&
        "three" === $value["id"]
    ) {
        return false;
    }
    return true;
});


a($a, $b, $c);
```

This will output:

```html
array(2) {
  [0] => array(2) {
    ["id"] => string(3) "one"
    ["children"] => array(0) {
    }
  }
  [1] => array(2) {
    ["id"] => string(3) "two"
    ["children"] => array(1) {
      [0] => array(2) {
        ["id"] => string(5) "three"
        ["children"] => array(0) {
        }
      }
    }
  }
}

array(0) {
}

array(2) {
  [0] => array(2) {
    ["id"] => string(3) "one"
    ["children"] => array(0) {
    }
  }
  [1] => array(2) {
    ["id"] => string(3) "two"
    ["children"] => array(0) {
    }
  }
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

    
intersect
-------------
2019-11-04


```php
array    intersect ( array:array, array:keys )
```

Returns an array containing all the key/value pairs of the given $array which keys are in the given $keys.



### Example



The following code:

```php
<?php 
$userCols = [
    "id" => 6,
    "pseudo" => "morris",
    "fake" => 789,
];
$realCols = ["id", "pseudo"];
az(ArrayTool::intersect($userCols, $realCols));

```

will produce this output:

```html 
array(2) {
  ["id"] => int(6)
  ["pseudo"] => string(6) "morris"
}
```

The following code:

```php
$userCols = [
    "kan" => 6,
];
$realCols = ["id", "pseudo"];
az(ArrayTool::intersect($userCols, $realCols));

```

will produce this output:

```html 
array(0) {
}

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


     
    
reduce
-------------
2019-09-17


```php
array reduce ( array:rows, string:column)
```

Returns a one dimensional numerically indexed array,
which values are the row[column] values.


### Example

The following code:

```php
<?php

$rows = [
    [
        "id" => 1,
        "name" => "paul",
    ],
    [
        "id" => 2,
        "name" => "mike",
    ],
];
az(ArrayTool::reduce($rows, "name"));

```
     
Will produce this output:

```html
array(2) {
  [0] => string(4) "paul"
  [1] => string(4) "mike"
}

```     
     
     
    
replaceRecursive
-------------
2019-11-05



```php
array replaceRecursive ( array tags, array &arr )
```


Parses the given array recursively replacing the tag keys by their values
directly in the array values, using str_replace under the hood.

Tags is an array of key/value pairs,
such as:

- {myTag} => 123
- {myTag2} => abc

Only scalar values are accepted.
If you need to replace with non scalar values such as arrays, you might
be interested in the [ArrayVariableResolver]https://github.com/lingtalfi/ArrayVariableResolver tool.



### Example


The following code:

```php
<?php

$arr = [
    'key1' => 'value 1',
    'key2' => '{computer} and {computer} and {fruit}',
];
$tags = [
    '{computer}' => 'mac',
    '{fruit}' => 'apple',
];

ArrayTool::replaceRecursive($tags, $arr);
az($arr);

```
     
     
Will produce the following output:

```html
array(2) {
  ["key1"] => string(7) "value 1"
  ["key2"] => string(21) "mac and mac and apple"
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


Updates an array recursively, like (php) array_walk_recursive, but adapted for nested item structures.

A nested item structure looks like this for instance:

-
     id: one
     label: One
     children: []
-
     id: two
     label: Two
     children:
         -
              id: three
              label: Three
              children: []



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
     
     





walkRowsRecursive
--------------
2019-09-06
     

```php
void    walkRowsRecursive (array $arr, callable $callback, $childrenKey=children, bool $triggerCallableOnParents = true )
```

Walks the given rows recursively, triggering the given callback on each row.

A row is an array.
Generally all rows have the same structure.
A row can contain other rows, in which case it's a parent row.
The parent row holds its children using a **children** key, which defaults to **children** (third argument).


The callable receives the row as its only argument.

By default, the callable is called for every row, including the parent rows.
If you want to trigger the callable only on leaves (rows with no children), you can set
the $triggerCallableOnParents flag to false.



### Example #1: collecting all items


The following code:
```php
<?php

$groups = [
    [
        'action_id' => 'Light_Realist-delete_rows',
        'text' => 'Delete',
        'icon' => 'far fa-trash-alt'
    ],
    [
        'text' => 'Share',
        'icon' => 'fas fa-share-square',
        'items' => [
            [
                'action_id' => 'Light_Realist-rows_to_csv',
                'icon' => 'far fa-envelope',
                'text' => 'Csv',
            ],
        ],
    ],
];



$all = [];
ArrayTool::walkRowsRecursive($groups, function (array $item) use (&$all) {
    $all[] = $item;
}, 'items');

az($all);
```     
     
Will output:

```html
array(3) {
  [0] => array(3) {
    ["action_id"] => string(25) "Light_Realist-delete_rows"
    ["text"] => string(6) "Delete"
    ["icon"] => string(16) "far fa-trash-alt"
  }
  [1] => array(3) {
    ["text"] => string(5) "Share"
    ["icon"] => string(19) "fas fa-share-square"
    ["items"] => array(1) {
      [0] => array(3) {
        ["action_id"] => string(25) "Light_Realist-rows_to_csv"
        ["icon"] => string(15) "far fa-envelope"
        ["text"] => string(3) "Csv"
      }
    }
  }
  [2] => array(3) {
    ["action_id"] => string(25) "Light_Realist-rows_to_csv"
    ["icon"] => string(15) "far fa-envelope"
    ["text"] => string(3) "Csv"
  }
}


```
     


### Example #2: collecting children only

The following code:

```php


$groups = [
    [
        'action_id' => 'Light_Realist-delete_rows',
        'text' => 'Delete',
        'icon' => 'far fa-trash-alt'
    ],
    [
        'text' => 'Share',
        'icon' => 'fas fa-share-square',
        'items' => [
            [
                'action_id' => 'Light_Realist-rows_to_csv',
                'icon' => 'far fa-envelope',
                'text' => 'Csv',
            ],
        ],
    ],
];



$children = [];
ArrayTool::walkRowsRecursive($groups, function (array $item) use (&$children) {
    $children[] = $item;
}, 'items', false);

az($children);

```


Will output:

```html

array(2) {
  [0] => array(3) {
    ["action_id"] => string(25) "Light_Realist-delete_rows"
    ["text"] => string(6) "Delete"
    ["icon"] => string(16) "far fa-trash-alt"
  }
  [1] => array(3) {
    ["action_id"] => string(25) "Light_Realist-rows_to_csv"
    ["icon"] => string(15) "far fa-envelope"
    ["text"] => string(3) "Csv"
  }
}

```

     


### Example #3: using the reference symbol

The following code:

```php

$groups = [
    [
        'action_id' => 'Light_Realist-delete_rows',
        'text' => 'Delete',
        'icon' => 'far fa-trash-alt'
    ],
    [
        'text' => 'Share',
        'icon' => 'fas fa-share-square',
        'items' => [
            [
                'action_id' => 'Light_Realist-rows_to_csv',
                'icon' => 'far fa-envelope',
                'text' => 'Csv',
            ],
        ],
    ],
];


ArrayTool::walkRowsRecursive($groups, function (array &$item)  {
    $item['mushroom'] = "ok";

}, 'items', false);


az($groups);

```


Will output:

```html

array(2) {
  [0] => array(4) {
    ["action_id"] => string(25) "Light_Realist-delete_rows"
    ["text"] => string(6) "Delete"
    ["icon"] => string(16) "far fa-trash-alt"
    ["mushroom"] => string(2) "ok"
  }
  [1] => array(3) {
    ["text"] => string(5) "Share"
    ["icon"] => string(19) "fas fa-share-square"
    ["items"] => array(1) {
      [0] => array(4) {
        ["action_id"] => string(25) "Light_Realist-rows_to_csv"
        ["icon"] => string(15) "far fa-envelope"
        ["text"] => string(3) "Csv"
        ["mushroom"] => string(2) "ok"
      }
    }
  }
}


```