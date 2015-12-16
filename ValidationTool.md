ValidationTool
=====================
2015-12-16



Tools for validating data.


Note: 
in this document, the bigbang.php script and the "a" function comes from the 
[portable autoloader technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md )



isEmail
-----------
2015-12-16


```php
bool    isEmail ( str:string )
```

Returns whether or not the given string is a valid email.


```php
<?php


use Bat\ValidationTool;

require_once "bigbang.php";

a(ValidationTool::isEmail("dora@explorer.com")); // true



``` 





