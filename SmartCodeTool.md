SmartCodeTool
=====================
2019-07-04



This class contains functions for manipulating smart codes.




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
