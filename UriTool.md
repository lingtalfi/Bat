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





fileGetContents
-----------
2016-12-02


```php
str|false    fileGetContents ( string:url )
```

Get the contents of a given url, or return false if it cannot be accessed.

Will try differents methods:
 
- file_get_contents if the php allow_url_fopen directive allows it
- or curl if installed






getWebsiteAbsoluteUrl
-----------
2016-11-26


```php
str|false    getWebsiteUrl ( )
```

Gets the absolute url for a website. Useful when you need to redirect a page using the php header function.





