StringTool
=====================
2015-10-14



This class contains functions for manipulating strings.




camelCase2Constant
-----------
2015-10-14




```php
str    camelCase2Constant ( string:str )
```


Converts a string in camel case to a php like constant.<br>
Exact nomenclature is defined in 
[string cases nomenclature]( https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.stringCases.eng.md )
 
 
```php
<?php


use Bat\StringTool;

require_once "bigbang.php";


$ar = [
    'camelCase',
    'thisIsNotCorrect',
    'simpleXML',
    'localDb2Remote',
    'notFound404',
];


foreach ($ar as $a) {
    a(StringTool::camelCase2Constant($a));
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







Note: the bigbang.php script and the "a" function comes from the 
[portable autoloader technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md )