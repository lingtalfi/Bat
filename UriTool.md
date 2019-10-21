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


use Ling\Bat\UriTool;

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






getHost
-----------
2017-06-07


```php
str|false    getHost ( )
```

Gets the host name, or false in case of error.




getWebsiteAbsoluteUrl
-----------
2016-11-26


```php
str|false    getWebsiteUrl ( )
```

Gets the absolute url for a website. Useful when you need to redirect a page using the php header function.




httpBuildQuery
-----------
2019-10-21


```php
str    httpBuildQuery ( array:parameters )
```

Returns the http query based on the given parameters.
It's almost like the http_build_query php function, except that it returns a non-url-encoded string.


### Example

The following code:

```php 
$getVars = [
    "files" => [
        'images/avatar.png',
        'photos/cat.png',
    ],
];
az(UriTool::httpBuildQuery($getVars));
```

Will output something like:

```html
string(50) "files[0]=images/avatar.png&files[1]=photos/cat.png"
```







uri
-----------
2017-04-18


```php
str|false    uri ( string:uri = null, array:params = [], bool:replace = true, bool:absolute = false )
```

A swiss army knife for uri.
It can return a relative or absolute url for a website,
including/replacing the existing parameters or even your parameters.






