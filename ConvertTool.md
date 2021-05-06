ConvertTool
=====================
2018-06-03 -> 2021-05-06



This class contains functions for conversion related tasks.



convertBytes
-----------
2018-06-03


```php
float    convertBytes ( int:bytes, string:destUnit=b, precision=2 )
```

Convert a bytes number to another unit.

If the unit is "h", then a human format is returned (i.e. the unit is chosen based on
human readability criteria).



```php
<?php


$sizeInMegaBytes = ConvertTool::convertBytes(566000000, "mb");
az($sizeInMegaBytes); // float(539.78)


```




convertHexColorToRgb
-----------
2019-02-22


```php
array    convertHexColorToRgb ( string hexColor ): array
```

Returns an array of rgb colors from the given $hexColor.

The returned array has the following structure.
- 0: red
- 1: green
- 2: blue

The given $hexColor can optionally be prefixed with a pound symbol (#).
The hexColor string must be exactly 6 chars long, or the BatException is thrown.


### Example:

The following code:

```php
<?php
$hex = "ff9900";
az(ConvertTool::convertHexColorToRgb($hex));

```


Will output:

```html
array(3) {
  [0] => int(255)
  [1] => int(153)
  [2] => int(0)
}

```



convertHumanSizeToBytes
-----------
2018-06-03


```php
int    convertHumanSizeToBytes ( string:humanSize )
```

Convert a human size to a number of bytes.


The $humanSize expression uses a human intuitive notation. All examples below are valid $humanSize expressions:

- 48          // 48 bytes
- 48b         // 48 bytes
- 48 b        // 48 bytes
- 48k         // 48 kilobytes
- 48 m        // 48 megabytes
- 2.6 M       // 2.6 megabytes
- 1.4 g       // 1.4 gigabytes
- 1.4 t       // 1.4 terabyte
- 1.4 p       // 1.4 petabyte
- 1.4 e       // 1.4 exabyte
- 1.4 z       // 1.4 zettabyte
- 1.4 y       // 1.4 yottabyte


The $humanSize expression is composed of two elements:

- a number
- a unit

The number represents the size.
The number is any number. Decimal numbers are accepted if the dot (.) or the comma (,) is used as a separator.

The unit represents the unit for the given size.
If omitted, it defaults to bytes.
All units are multiple of 1024 (i.e. not 1000).
A unit is always expressed with one (and only one letter), which can be either lower case or upper case.
It's possible to add whitespace(s) between the number and the unit components.
All possible units are exposed in the example above.



```php
<?php


$sizeInBytes = ConvertTool::convertHumanSizeToBytes( "5M");
az($sizeInBytes); // int(5242880)


```



getPhpErrorLabel
----------
2020-06-01


```php
string    getPhpErrorLabel ( int:errorNumber )
```

Returns the error label corresponding to the given error number, based on this page: [https://www.php.net/manual/en/errorfunc.constants.php](https://www.php.net/manual/en/errorfunc.constants.php).
     
     

```php
<?php

a(ConvertTool::getPhpErrorLabel( 2)); // E_WARNING
az(ConvertTool::getPhpErrorLabel( \E_USER_NOTICE)); // E_USER_NOTICE

```



toPrice
----------
2021-05-06


```php
string    toPrice ( str:price, str:decimalSeparator=".")
```


Returns a price string formatted as a number with two decimals, but without the currency symbol.
It looks like this:

- 49.99
- 250.00


If the given value has more than 3 decimals, we round it up.
So for instance 4.875 will be rounded to 4.88 (i.e. not 4.87).

     
    