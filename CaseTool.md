CaseTool
=====================
2015-12-22



This class contains functions for converting a case to another.
String cases are defined in the [string case nomenclature](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md) by the convention guy.



Note: 
some examples use the **a** function, which comes from the [bigbang technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md ).
If you don't use bigbang, you can use var_dump as a replacement.




camel2Constant
-----------
2015-12-22






```php
str    camel2Constant ( string:str )
```


Converts a string in camel case to a php like constant.<br>
Exact nomenclature is defined in 
[string cases nomenclature]( https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md )
 
 
```php
<?php


use Ling\Bat\CaseTool;

require_once "bigbang.php";


$ar = [
    'camelCase',
    'thisIsNotCorrect',
    'simpleXML',
    'localDb2Remote',
    'notFound404',
];


foreach ($ar as $a) {
    a(CaseTool::camel2Constant($a));
}
 

/**
 * The output:
 *
 * string 'CAMEL_CASE' (length=10)
 * string 'THIS_IS_NOT_CORRECT' (length=19)
 * string 'SIMPLE_XML' (length=10)
 * string 'LOCAL_DB_2_REMOTE' (length=17)
 * string 'NOT_FOUND_404' (length=13)
 * 
 * 
 */ 
 
``` 



snakeToCamel
-----------
2017-06-09




```php
str    snakeToCamel ( string:str )
```


Converts a string in snake case to a string in camel case.
[string cases nomenclature]( https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md )
 
 

snakeToPascal
-----------
2015-12-22




```php
str    snakeToPascal ( string:str )
```


Converts a string in snake case to a string in pascal case (most php classes use the pascal case or a variant of it)<br>
Exact nomenclature is defined in 
[string cases nomenclature]( https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md )
 
 
```php
<?php


use Ling\Bat\CaseTool;

require_once "bigbang.php";


$ar = [
    '',
    'just a test sentence to start with',
    'and_now_real_shit',
    'and_now_real_XML',
    'and_now_real__XML',
    'AND_NOW_REAL__XML',
];


foreach ($ar as $a) {
    a(CaseTool::snakeToPascal($a));
}
 


 
/**
 * The output looks like this (in a browser): 
 *  
 * string '' (length=0)
 * string 'Just a test sentence to start with' (length=34)
 * string 'AndNowRealShit' (length=14)
 * string 'AndNowRealXml' (length=13)
 * string 'AndNowRealXml' (length=13)
 * string 'AndNowRealXml' (length=13)
 */

```




 

snakeToFlexiblePascal
-----------
2018-08-18




```php
str    snakeToFlexiblePascal ( string:str )
```


Converts a string in snake case to a string in flexible pascal case<br>
Exact nomenclature is defined in 
[string cases nomenclature]( https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md )
 
 
```php
<?php


use Ling\Bat\CaseTool;

require_once "bigbang.php";


$ar = [
    '',
    'just a test sentence to start with',
    'and_now_real_shit',
    'and_now_real_XML',
    'and_now_real__XML',
    'AND_NOW_REAL__XML',
];


foreach ($ar as $a) {
    a(CaseTool::snakeToFlexiblePascal($a));
}
 


 
/**
 * The output looks like this (in a browser): 
 *  
 * string(0) ""
 * string(34) "Just a test sentence to start with"
 * string(14) "AndNowRealShit"
 * string(13) "AndNowRealXML"
 * string(13) "AndNowRealXML"
 * string(13) "ANDNOWREALXML"
 */

```



snakeToRegular
-----------
2015-12-29




```php
str    snakeToRegular ( string:str )
```


Converts a string in snake case to a regular string.
Snake case is defined in
[string cases nomenclature]( https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md )


```php
<?php


use Ling\Bat\CaseTool;

require_once "bigbang.php";


$str = "mi_chel__a_bu";
a(CaseTool::snakeToRegular($str)); // mi chel a bu

```


toCamel
-----------
2017-10-30


```php
str    toCamel ( str:string )
```

Return the [camelCase version](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#camelcase) of the given string.



```php
<?php
a(CaseTool::toCamel("MY DOG")); // myDog
```


toConstant
-----------
2018-05-01


```php
str    toConstant ( str:string )
```

Return the [constantCase version](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#constantcase) of the given string.



toDash
-----------
2018-05-01


```php
str    toDash ( str:string )
```

Return the [dashCase version](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#dashcase) of the given string.






toDog
-----------
2016-01-07


```php
str    toDog ( str:string )
```

Return the [dog version](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#dog-case) of the given string.



```php
<?php


use Ling\Bat\CaseTool;

require_once "bigbang.php";


a(CaseTool::toDog("Hello everybody, is it ok?")); // hello-everybody-is-it-ok
```


toPortableFilename
-----------
2019-10-01



```php
str    toPortableFilename ( str:string )
```

Returns the portable filename version of the given string.
More info about portable filename here: https://github.com/lingtalfi/NotationFan/blob/master/portable-filename.md.



Example
----------

The following code:

```php

a(CaseTool::toPortableFilename("Ok it's good hala/vista"));
a(CaseTool::toPortableFilename("pata-one_and_two.md"));

az();
```

Will produce this output:

```html

string(18) "Okitsgoodhalavista"

string(19) "pata-one_and_two.md"

```



toFlea
-----------
2016-01-07


```php
str    toFlea ( str:string )
```

Return the [flea version](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#flea-case) of the given string.

This case comes handy to ensure safe name for uploaded files.


```php
<?php

use Ling\Bat\CaseTool;

require_once "bigbang.php";


a(CaseTool::toFlea("abraham/../...jpg")); // abraham.jpg
```



toFlexibleCamel
-----------
2018-05-01


```php
str    toFlexibleCamel ( str:string )
```

Return the [flexibleCamelCase version](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#flexiblecamelcase) of the given string.



toFlexibleDash
-----------
2018-05-01


```php
str    toFlexibleDash ( str:string )
```

Return the [flexibleDashCase version](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#dlexibledashcase) of the given string.





toFlexiblePascal
-----------
2018-05-01


```php
str    toFlexiblePascal ( str:string )
```

Return the [flexiblePascal version](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#flexiblepascalcase) of the given string.



toPascal
-----------
2018-05-01


```php
str    toPascal ( str:string )
```

Return the [pascal version](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#pascalcase) of the given string.






toSnake
-----------
2016-01-06


```php
str    toSnake ( string:str, bool:processUpperLetters=false )
```

Return the [snake version](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md#snake-case) of the given string.



```php
<?php


use Ling\Bat\CaseTool;

require_once "bigbang.php";


a(CaseTool::toSnake("Hello everybody, is it ok?")); // hello_everybody_is_it_ok
```

Use the second argument to consider upper letters as special characters:

```php
<?php


use Ling\Bat\CaseTool;

require_once "bigbang.php";


a(CaseTool::toSnake("MyClassIsKool", true)); // my_class_is_kool
```




unsnake
-----------
2015-12-29

Alias to the [snakeToRegular](https://github.com/lingtalfi/Bat/blob/master/CaseTool.md#snaketoregular) method