StringTool
=====================
2015-10-14



This class contains functions for manipulating strings.




Note: 
some examples require a bigbang script and use the **a** function. More on this here in the [bigbang technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md ).






autoCast
-----------
2015-12-14

A proxy to Tiphaine::autoCast method.
See [Tiphaine](https://github.com/lingtalfi/Tiphaine) for more info.


```php
str    autoCast ( string:str )
```





camelCase2Constant
-----------
2015-10-14




```php
str    camelCase2Constant ( string:str )
```


Converts a string in camel case to a php like constant.<br>
Exact nomenclature is defined in 
[string cases nomenclature]( https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md )
 
This method is an alias to the [CaseTool:camel2Constant](https://github.com/lingtalfi/Bat/blob/master/CaseTool.md#camel2Constant) method since 1.22.
See the CaseTool:camel2Constant documentation for more info.

 


cutNumericalSuffix
-----------
2015-11-02

```php
array(str:string, false|int:numericalSuffix)    cutNumericalSuffix( str:string )
```


This method takes a string, and returns an array containing two entries:

- the string without the numerical suffix
- the numerical suffix or false if the last chars are not numerical

For instance,

    hello68 => [hello, 68]
    hello => [hello, false]
    hello-78.79 => [hello78., 79]
    123 => ["", 123]



getPlural
-----------
2018-02-13


```php
string      getPlural (string:word)
```

Returns the plural form of the given word.


```php
a(StringTool::getPlural("cat")); // cats
```


getUniqueCssId
-----------
2017-04-28


```php
string      getUniqueCssId ( string:prefix = "" )
```

Returns a "unique" identifier to use as a css id, possibly prefixed with a given string.


```php
a(StringTool::getUniqueCssId("po-")); // po-7d92af3dddd5083eb7432686c2a9f2ca
```




htmlAttributes
-----------
2015-10-28 -> 2017-05-03


```php
str    htmlAttributes ( array:attributes, str:keyPrefix="" )
```


Returns an html attributes string based on the given attributes array.
Support arguments with just value, like checked for example.

Also, if an argument value is null, it is omitted;
this behaviour might be useful in this case where we define default attributes values, 
then we can **unset** them by setting a null value.


Example of use:


```php
$attr = [
    'class' => 'foo bar',
    'style' => 'color: red',
    'required',
    'id' => null,
];


$ret = StringTool::htmlAttributes($attr); 
az($ret); // $ret = ' class="foo bar" style="color: red" required'
```




relativePath 
---------------
2017-11-30


```php
str    relativePath ( str:absoluteBaseDir, str:absolutePath, mixed:default = null )
```

Drop the absoluteBaseDir string in front of the absolutePath.

If it's not in front, the returned value depends on the default parameter:
- if default is null, the absolutePath is returned
- else default is returned



Example of use:

```php
<?php

a(StringTool::relativePath("/p/a/c", "/p/a/c/man.txt")); // return /man.txt

```







removeAccents
---------------
2016-01-07


```php
str    removeAccents ( str:string )
```

Replace accentuated letters with their non accentuated equivalent.


Example of use:

```php
<?php


use Bat\StringTool;

require_once "bigbang.php";



a(StringTool::removeAccents("métisse")); // metisse

```







replacePortion
-----------
2015-11-19


Cuts a portion of a string, and replaces it with a replacement string.


```php
str    replacePortion ( str:string, int:start, int:length, str:replacement )
```

- start: the position where to start the cut. If start is bigger than the string's length, then the text will be inserted at the end of the string.
- length: the length of the cut
- replacement: the replacement string



### Example

```php
<?php


use Bat\StringTool;

require_once "bigbang.php";

a(StringTool::replacePortion('abcdef', 1, 2, 'ppp')); // apppdef



```



split
-----------
2015-11-30


Split the given (assumed) string into an array of multi-byte characters.
The internal encoding used is the one returned by the php's mb_internal_encoding function.


```php
array    split ( str:string )
```


### Example

```php
<?php


use Bat\StringTool;

require_once "bigbang.php";


$string = "été";
a(StringTool::split($string));  // [é, t, é]



```









strPosAll
-----------
2015-11-12

```php
array:positions strPosAll( str:haystack, str:needle, int:offset=0 )
```

Returns an array of positions of needle in haystack, starting at the given offset.
It uses the encoding given by the mb_internal_encoding php function, which is utf-8 by default.

Example:


The following script uses the [portable autoloader](https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md) technique.

```php
<?php

use Bat\StringTool;

require_once "bigbang.php";



a(mb_internal_encoding());

$str = "Hum, hello, did you hear me say hello?";
a(StringTool::strPosAll($str, 'hello'));



$str = "Cet été, il faisait beau. Cet été c'était bien.";
a(StringTool::strPosAll($str, 'été'));


mb_internal_encoding('iso-8859-1'); // checking that StringTool uses the encoding set with the mb_internal_encoding function
$str = "Cet été, il faisait beau. Cet été c'était bien.";
a(StringTool::strPosAll($str, 'été'));

```
The output of the above script looks like this:

```
string 'UTF-8' (length=5)

array (size=2)
  0 => int 5
  1 => int 32

array (size=2)
  0 => int 4
  1 => int 30

array (size=2)
  0 => int 4
  1 => int 32

```




ucfirst
-----------
2017-05-23

```php
string ucfirst( str:string )
```

Like ucfirst, but using utf8 (works with accentuated letters).




unserializeAsArray
-----------
2017-12-12

```php
mixed unserializeAsArray(str:string)
```

When you need to unserialize a field from your database and you expect an array,
you can use this function.

Note that even if your application always put a serialized version of your array
in the database, an accident could happen (you accidentally update the field directly
via phpMyAdmin for instance), and you end up with a flat string.
So, this method deals with this case.










