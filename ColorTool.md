ColorTool
=====================
2019-05-24



This class contains functions related to colors.



hexToHsl
-----------
2019-05-24


```php
array    hexToHsl ( str:hex )
```

Returns the hsl array from an hex color code (prefixed or not prefixed with the hash symbol).

The returned hsl array has three entries:

- h
- s
- l


The following code:

```php
<?php


$hex = '#007bff';
a(ColorTool::hexToHsl($hex));

```

Will output:

```html
array(3) {
  [0] => float(211.05882352941)
  [1] => int(1)
  [2] => float(0.5)
}

```




hexToRgb
-----------
2019-05-24


```php
array    hexToRgb ( str:hex )
```

Returns an array of rgb colors from the given $hexColor (prefixed or not prefixed with the hash symbol).

The returned array has the following structure:

- r
- g
- b


The following code:

```php
<?php


$hex = '#007bff';
a(ColorTool::hexToRgb($hex));

```

Will output:

```html
array(3) {
  [0] => int(0)
  [1] => int(123)
  [2] => int(255)
}


```





hslToHex
-----------
2019-05-24


```php
string    hslToHex ( array:hsl )
```

Returns the hex color code corresponding to the given hsl array.

The given hsl array must have three entries:

- h
- s
- l


The following code:

```php
<?php


$hsl = [
    211,
    1,
    0.5,
];
a(ColorTool::hslToHex($hsl));

```

Will output:

```html
string(7) "#007bff"


```




hslToRgb
-----------
2019-05-24


```php
array    hslToRgb ( array:hsl )
```

Returns the rgb array corresponding to the given hsl array.

The returned rgb array has three entries:

- r
- g
- b

The given hsl array must have three entries:

- h
- s
- l

The following code:

```php
<?php


$hsl = [
    211,
    1,
    0.5,
];
a(ColorTool::hslToRgb($hsl));

```

Will output:

```html
array(3) {
  [0] => float(0)
  [1] => float(123)
  [2] => float(255)
}



```




isDark
-----------
2019-05-24


```php
bool    isDark ( str:hex )
```

Returns whether the given hex color code (prefixed or not prefixed with a hash symbol) is dark.

The following code:

```php
<?php


$hex = '#007bff';
a(ColorTool::isDark($hex));

```

Will output:

```html
bool(true)


```




rgbToHex
-----------
2019-05-24


```php
string  rgbToHex ( array:rgb )
```

Returns the hex color code from an rgb array.

The given rgb array must have three entries:

- r 
- g 
- b 

The returned hex color code is prefixed with a hash symbol.


The following code:

```php
<?php


$rgb = [
    0,
    123,
    255,
];
a(ColorTool::rgbToHex($rgb));

```

Will output:

```html
string(7) "#007bff"



```




rgbToHex
-----------
2019-05-24


```php
string  rgbToHex ( array:rgb )
```

Returns the hex color code from an rgb array.

The given rgb array must have three entries:

- r 
- g 
- b 

The returned hex color code is prefixed with a hash symbol.


The following code:

```php
<?php


$rgb = [
    0,
    123,
    255,
];
a(ColorTool::rgbToHex($rgb));

```

Will output:

```html
string(7) "#007bff"



```



