MiniCsvTool
=====================
2021-07-06



This class contains functions to work with miniCsv strings.






getCsvArray
-----------
2021-07-06


```php
getCsvArray ( string $miniCsv): array 
```


Returns the csv array from the given minicsv string.
Values from the returned array are always trimmed.


Example:

```php
$s = '1:15, 2:16, 3:7, 4:7, 5:11';
$arr = MiniCsvTool::getCsvArray($s);
az($arr);
```

Outputs:

```html
array(5) {
  [0] => string(4) "1:15"
  [1] => string(4) "2:16"
  [2] => string(3) "3:7"
  [3] => string(3) "4:7"
  [4] => string(4) "5:11"
}

```



getCsvPairs
-----------
2021-07-06


```php
getCsvPairs ( string $miniCsv, string $pairDelimiter = ":" ): array 
```


Returns an array of key/value pairs defined in the given minicsv string.
Each csv value represents a key/value pair, which separator is the colon char (:) by default.

If a value doesn't contain the pairDelimiter, the key of the returned pair becomes the value,
and the value of the pair is an empty string.


Example:

```php
$s = '1:15, 2:16, 3:7, paul:7, 5:11';
$arr = MiniCsvTool::getCsvPairs($s);
az($arr);

```

Outputs:

```html
array(5) {
[1] => string(2) "15"
[2] => string(2) "16"
[3] => string(1) "7"
["paul"] => string(1) "7"
[5] => string(2) "11"
}


```
