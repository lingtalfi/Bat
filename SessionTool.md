SessionTool
=====================
2017-05-17



This class contains functions for manipulating sessions.





destroyAll
-----------
2017-05-30

Destroy all variables in the session, plus the session cookie.


```php
void destroyAll(  )
```




Example:

```php
<?php

SessionTool::destroyAll();

```


destroyPartial
-----------
2017-05-17

Destroy some of the variables in the session


```php
void destroyPartial( mixed:keys )
```

keys can be an array or a string, it represents the key(s) to destroy.




Example:

```php
<?php

SessionTool::destroyPartial("myid");
header("Location: http://mysite.com/an/uri");
exit;

```




dump
-----------
2017-10-27

return some keys in the session


```php
array|mixed dump( mixed:keys = null, mixed:removeKeys = null, bool:useBdot = true )
```

Keys represent the key(s) of the session to display.
Remove keys represent the key(s) of the session to hide.

Both keys and removeKeys can be a scalar value or an array.
If keys is null, this means show all keys.
If removeKeys is null, this means hide no keys.

If useBdot is true, you can use the bdot notation.






Example:

```php
<?php

/**
 * Show all entries in the session, except those with keys being one of:
 * - ekom[cart]
 * - ekom[estimateCart]
 * - ekom[order.singleAddress]
 * 
 * Note: the bdot notation is used in this example
 * 
 */
a(SessionTool::dump(null, [
        'ekom.cart',
        'ekom.estimateCart',
        'ekom.order\\.singleAddress',
    ]));

```



get
-----------
2018-02-26


Get a variable from the session

```php
mixed set(str:key, mixed:default=null )
```





set
-----------
2018-02-26


Set a variable in the session

```php
void set(str:key, mixed:value )
```



start
-----------
2017-05-22


Starts a php session if it's not already started

```php
void start( )
```
