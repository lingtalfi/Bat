PsvTool
=====================
2021-07-06



This class contains functions for manipulating psv strings.

The word "psv" stands for protected separated values.
Where protected is a string properly wrapped with quotes (either single quotes or double quotes).

The escape char is the backslash char (\).
The escape char can only escape quotes (i.e., not the comma).






explodeProtected
----------
2021-06-28


```php
public static function explodeProtected(string $psv, int $limit = 0): array
```



Returns an array containing the different values of the given psv.

This works similarly to the php explode function.

utf-8 encoding is assumed (I guess, see the source code for more hints).

Any malformed value (i.e., not wrapped with quotes) will result in an empty string.

For instance, the following:

- "ok", , nope, , "ok",

will result in the following array:

- "ok", "", "", "", "ok", "".




### Example
2021-06-28

The following code:


```php 
$list = [
    "'M','F'", // simple enum
    "'Méchant','F'", // testing accent (utf-8)
    "'Aujourd\'hui','F'", // testing escaping
    "'Aujourd\'hui','F', \"paul\"", // testing different quote types
    "'Aujourd\'hui','F', \"paul\", \"p\\\"eter\"", // testing different quote types 2
    "'a', 'b', , nope, 'd',  ", // testing malformed values
];

foreach ($list as $psv) {

    $res = PsvTool::explodeProtected($psv);
    a($psv, $res);
}
az();
```

Will output something like this:


```html
string(7) "'M','F'"

array(2) {
  [0] => string(1) "M"
  [1] => string(1) "F"
}

string(14) "'Méchant','F'"

array(2) {
  [0] => string(8) "Méchant"
  [1] => string(1) "F"
}

string(18) "'Aujourd\'hui','F'"

array(2) {
  [0] => string(11) "Aujourd'hui"
  [1] => string(1) "F"
}

string(26) "'Aujourd\'hui','F', "paul""

array(3) {
  [0] => string(11) "Aujourd'hui"
  [1] => string(1) "F"
  [2] => string(4) "paul"
}

string(37) "'Aujourd\'hui','F', "paul", "p\"eter""

array(4) {
  [0] => string(11) "Aujourd'hui"
  [1] => string(1) "F"
  [2] => string(4) "paul"
  [3] => string(6) "p"eter"
}

string(24) "'a', 'b', , nope, 'd',  "

array(6) {
  [0] => string(1) "a"
  [1] => string(1) "b"
  [2] => string(0) ""
  [3] => string(0) ""
  [4] => string(1) "d"
  [5] => string(0) ""
}


```








implode
----------
2021-07-06


```php
public static function implode(string $delim, array $values, $quoteType = "s"): string
```



Joins array elements in protected components separated by the given delim.
The protection depends on the quote type:

- s: single quote
- d: double quote




### Example
2021-07-06

The following code:


```php 

$s = PsvTool::implode(",", ["hello", "1", "world"]);
az($s);

```

Will output something like this:


```html
string(19) "'hello','1','world'"


```


