SmartCodeTool
=====================
2019-07-04



This class contains functions for manipulating [smart codes](https://github.com/lingtalfi/NotationFan/blob/master/smart-code.md).




parse
-----------
2019-07-04


Parses the given $expr and returns the corresponding result.

Under the hood, the babyYaml inline parser is used.
Please refer to the BabyYaml documentation for more details.


```php
mixed parse (str:expression)
```


### Example


The following: 
```php
a(SmartCodeTool::parse("hi"));
a(SmartCodeTool::parse("[a, b, c]"));
a(SmartCodeTool::parse("{one: ok, two: bad, three: ok}"));
a(SmartCodeTool::parse("{one: ok, two: [a, b, c], three: ok}"));
```


Will output this:


```html
string(2) "hi"

array(3) {
  [0] => string(1) "a"
  [1] => string(1) "b"
  [2] => string(1) "c"
}

array(3) {
  ["one"] => string(2) "ok"
  ["two"] => string(3) "bad"
  ["three"] => string(2) "ok"
}

array(3) {
  ["one"] => string(2) "ok"
  ["two"] => array(3) {
    [0] => string(1) "a"
    [1] => string(1) "b"
    [2] => string(1) "c"
  }
  ["three"] => string(2) "ok"
}

```



parseArguments
-----------
2019-09-18


Parses the given $expr as if it was the arguments of a function, and returns the resulting array.



```php
array parseArguments (str:expression)
```

So for instance, the string: "a, b, c"

Would return the array:
- 0: a
- 1: b
- 2: c





replaceSmartCodeFunction
-----------
2019-09-18


Replaces the smartCodeFunctions calls found in the given array with their replacement.

A smartCodeFunction call has the following notation:

- $functionName ( $smartCodeArguments )

With:

- $functionName, the given function name
- $smartCodeArguments, a string representing the smart code arguments.


The given replaceFunc will be called whenever the smartCodeFunction is detected.
It will be executed with the smart code arguments as parameters.
Its value will be the replacement value used.

Note: if the smartCodeFunction notation is part of a bigger string, then the replacement value
must be stringable (i.e. not an array), otherwise an exception will be thrown.


Note: spaces around the parenthesis wrapping the $smartCodeArguments don't matter.

Note: functionName should contain only alpha-numerical characters, or underscore (like a php function name),
otherwise results are unpredictable.


The options array contains the following properties:

- openingParenthesisSymbol: (
- closingParenthesisSymbol: )

Note: generally, we need to use the openingParenthesisSymbol and closingParenthesisSymbol options only when
if we know in advance that the arguments of our smartCodeFunction might contain regular parenthesis (which is often not the case).



Example
--------

The following php code:

```php

$arr = [
    "a" => "apple",
    "b" => "banana",
    "c" => [
        "cherry" => 654,
        "cherry2" => 'CHERRY(123)',
        "cherry3" => 987,
    ]
];
SmartCodeTool::replaceSmartCodeFunction($arr, "CHERRY", function ($val) {
    return $val;
});


az($arr);

```


Will output:

```html

array(3) {
  ["a"] => string(5) "apple"
  ["b"] => string(6) "banana"
  ["c"] => array(3) {
    ["cherry"] => int(654)
    ["cherry2"] => int(123)
    ["cherry3"] => int(987)
  }
}

```

