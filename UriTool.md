UriTool
=====================
2015-12-04



This class contains functions for manipulating uri.


Note: 
in this document, the bigbang.php script and the "a" function comes from the 
[portable autoloader technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md )



Note2:
The uri nomenclature that we use is the [ConventionGuy's uri nomenclature](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature/nomenclature.uri.eng.md)



appendQueryString
-----------
2015-10-14


```php
str    appendQueryString ( string:baseUri, array:parameters=[] )
```

Appends parameters to a base uri, and in the form of a query string (starting with a question mark).


```php
<?php


use Bat\UriTool;

require_once "bigbang.php";


a(UriTool::appendQueryString('/home', ['template' => 'yellow', 'user' => 'me'])); // /home?template=yellow&user=me
``` 





