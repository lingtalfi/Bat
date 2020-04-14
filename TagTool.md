TagTool
=====================
2020-04-14



This class contains functions for manipulating tags.


A tag name is wrapped with curly brackets like {that}.

The tag can only be replaced with a string (or stringable).

A tag name must not contain the "}" (closing curly bracket) character.


Note: if you need to replace a tag with something else than a string, consider using the [ArrayVariableResolver](https://github.com/lingtalfi/ArrayVariableResolver) utility.



applyTags
-------------
2020-04-14


```applyTags(array $tags, array &$arr): void```


Applies the given tags to the given array in place.
This method is recursive.


### Example


```php
<?php


use Ling\Bat\TagTool;


$tags = [
    "fruit" => 'apple',
    "name" => 'john',
];
$arr = [
    "one" => "Hi, my name is {name}-{name}",
    "two" => [
        "two-a" => "this is a {fruit}",
    ],
];
TagTool::applyTags($tags, $arr);
az($arr);
/**
 * array(2) {
 *      ["one"] => string(24) "Hi, my name is john-john"
 *      ["two"] => array(1) {
 *          ["two-a"] => string(15) "this is a apple"
 *      }
 * }
 */
```

