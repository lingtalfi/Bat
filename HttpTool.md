HttpTool
=====================
2017-06-27 -> 2020-12-07



This class contains functions for manipulating HttpProtocol.






getHttpResponseCode
-------------
2020-12-07



```php

int getHttpResponseCode(string:url)
```


Returns the http response code obtained when fetching the given $url.

Throws an exception in case of failure.







isHttps
-------------
2017-12-11



```php
bool    isHttps ()
```

Returns whether or not the current process uses https.




post
-------------
2017-06-27



```php
str|false    post ( string:uri, array:data=[] )
```

Post the given data to the given uri, and return the result.




