StringTool
=====================
2015-10-14 -> 2021-07-22



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




countCapitals
-----------
2021-06-21




```php
int    countCapitals ( string:str )
```


Returns the number of capitals in the given string.



cutAtWordBoundary
-----------
2021-07-22




```php
str    cutAtWordBoundary ( string:str, int:maxNbChars = 250, str:ending="...")
```


Returns a subset of the given string, which doesn't cut a word in half, and which length is the closest to the given maxNbChars without being higher.

In addition to that, the ending string is added only if the str length is greater than the given maxNbChars limit.

The given string preferably shouldn't contain any PHP_EOL chars.

Example:

```php 
$s = "This is a test sentence.";
a(StringTool::cutAtWordBoundary($s, 15)); // This is a test...
```



cutNumericalSuffix
-----------
2015-11-02 -> 2020-10-23

```php
array(str:string, false|int:numericalSuffix)    cutNumericalSuffix( str:string )
```


This method takes a string, and returns an array containing two entries:

- the string without the numerical suffix
- the numerical suffix or false if the last chars are not numerical

For instance:
```txt
hello68 => [hello, 68]
hello => [hello, false]
hello-78.79 => [hello78., 79]
123 => ["", 123]
```



endsWith
-----------
2020-10-23


```php
bool      endsWith (string:haystack, string:needle)
```

Returns whether the given haystack string ends with the given needle string.


```php
a(StringTool::endsWith("boris", 'bo')); // false
az(StringTool::endsWith("boris", 'ris')); // true

```



getCompactString
-----------
2020-11-20


```php
string      getCompactString (string:str)
```

Returns a more compact version of the given string.

More compact means:
- trimmed
- consecutive whitespaces are reduced to one space





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


getSymbolicPath
-----------
2021-06-21


```php
string      getSymbolicPath (string:path, string:appDir)
```

Returns a symbolic path, where the given absolute path to the application directory is replaced by the symbol [app].



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




getUniqueDuplicatedName
-----------
2021-04-06


```php
string      getUniqueDuplicatedName ( string:identifier, callable:doesItStillExist )
```

Returns a unique identifier, based on the given one.

If you provide an identifier of:

- abc

Then the duplicated entries will look like this:

- abc copy
- abc copy 2
- abc copy 3
- ...



The given callable makes sure than the new identifier does not exist.
It takes the tested identifier as the input, and returns whether that identifier exists or not.
If not, then it's returned as the chosen identifier.






Testing rig:

```php

$pool = [
    'abc',
    "abc copy",
    "abc copy111",
    "abc copy 2",
    "abc copy 3",
    "abc copy 4",
    "abc copy 5",
    "abc copy 6",
    "abc copy 7",
    "abc copy 8",
    "abc copy 9",
    "abc copy 10",
    "abc copy 11",
];


$match = StringTool::getUniqueDuplicatedName("abc", function ($id) use ($pool) {
    return in_array($id, $pool, true);
});


az("match=$match");
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



humanizeFileName
-----------
2019-04-03


```php
str     humanizeFileName(str:fileName, bool:firstLetterUppercase = false)
```

Returns a humanized version of a file name.

Basically, the file extension (if any) is dropped, and then dashes, underscores and dots are
converted into spaces, and all words are turned down to lowercase.


### Examples


```php
$f = "easy-menu-configuration.file.md";
a(StringTool::humanizeFileName($f)); // easy menu configuration file


$f = "easy-menu-  ___.-configuration.file.md";
a(StringTool::humanizeFileName($f, true)); // Easy menu configuration file
```



incrementNumericalSuffix
-----------
2019-08-27



```php
str    incrementNumericalSuffix ( str:proposition, array:pool, bool:useKey=false, str:separator=__ )
```


Returns a string based on the proposition, which is not found in the given pool.
The returned string has the following format:

- {baseString} {separator} {numericalValue}

We can search against the keys of the pool (useKey=true), or against the values of the pool (useKey=false).

The baseString shouldn't contain the separator, otherwise results are unpredictable.


Example of use:


The following code:

```php


$str = "my_value";
$pool = [
    "my_value",
    "my_value__1",
    "my_value__2",
];

a(StringTool::incrementNumericalSuffix($str, $pool, false));


$str = "my_value";
$pool = [
    "my_value" => 66,
    "my_value__1" => 66,
    "my_value__2" => 66,
];

az(StringTool::incrementNumericalSuffix($str, $pool, true));
```

Will output:

```html
string(11) "my_value__3"

string(11) "my_value__3"


```



indent
-----------
2019-02-15


```php
str    indent ( string:string, int:indentNumber )
```


Returns the given $string, but indented with the $indentNumber spaces for every line.


Example of use:


The following code:

```php
$string = <<<EEE
    
This property holds the style to apply to the widget.
The following values are available:
- flat: the section titles (properties, methods) are written with doc comments, and the actual elements (properties, methods)
     are written as top level elements of a list

- indented: the section titles are written as top level elements of a list, and the actual elements are their children (nested list elements).
     This is the default value


@var string = indented (indented|flat)
     
EEE;

a(StringTool::indent($string, 4));
```

Will output:

```html
string(539) "        
    This property holds the style to apply to the widget.
    The following values are available:
    - flat: the section titles (properties, methods) are written with doc comments, and the actual elements (properties, methods)
         are written as top level elements of a list
    
    - indented: the section titles are written as top level elements of a list, and the actual elements are their children (nested list elements).
         This is the default value
    
    
    @var string = indented (indented|flat)
         "

```



isStringable
-----------
2019-09-18


```php
bool    isStringable ( mixed:value )
```


Returns whether the given value can be turned into a string.




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


use Ling\Bat\StringTool;

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


use Ling\Bat\StringTool;

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


use Ling\Bat\StringTool;

require_once "bigbang.php";


$string = "été";
a(StringTool::split($string));  // [é, t, é]



```




startsWith
-----------
2020-10-23


```php
bool      startsWith (string:haystack, string:needle)
```

Returns whether the given haystack string starts with the given needle string.


```php
a(StringTool::startsWith("boris", 'bo')); // true
az(StringTool::startsWith("boris", 'ris')); // false
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

use Ling\Bat\StringTool;

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








toCsv
-----------
2020-09-08

```php
string toCsv( arr:keyValueParams, arr:options=[] )
```


Returns a comma separated string version of the given key/value pairs array.
Note: by default there is a space after each comma separator.

Available options are:
- commaSep: string, the expression to use as the comma separator. The default value is a comma followed by a space (, ).
- equalSep: string, the expression to use as the equal separator (i.e. between the key and the value). The default value is the equal symbol (=).




truncate
-----------
2020-11-24

```php
string truncate( str:expr, arr:options=[] )
```

Returns the truncated version of the given expression.

If the expression's length is greater than the given maxLen,
we add an ellipsis to it, which defaults to three consecutive dots (...).


Note: that the total length of the expression plus the ellipsis will then be maxLen (i.e. and not maxLen + ellipsisLen).
That's because the intent of this method was to prepare data for insertion in a database, which has strict limitations.

If the length of the ellipsis is greater than the length of the given expression, then the ellipsis is not used at all,
and the expression is truncated without suffix.


Available options are:
- ellipsis: string=null, the ellipsis to use. If null, defaults to three consecutive dots (...)



### Example

```php
$expr = "hello there!";
az(StringTool::truncate($expr, 5)); // string(5) "he..."
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










