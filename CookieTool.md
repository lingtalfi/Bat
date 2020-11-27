CookieTool
=====================
2020-11-27



This class contains functions for helping with cookies.




add
-----------
2020-11-27


```php
add(string $name, $value, int $nbDays = 0, array $options = []): void
```

Sets a cookie.
By default, the cookie lasts the specified number of days and is secure (httponly=true and secure=true).

This method must be called before any output is sent to the browser.
See https://www.php.net/manual/en/features.cookies.php for more info.


Available options:
- path: same as php doc
- domain: same as php doc
- secure: same as php doc
- httponly: same as php doc
- expires: same as php doc. If set, will override the $nbDays argument.

     
     
     
all
-----------
2020-11-27


```php
all(): array
```
Returns the array of all cookie names sent by the client.
     
     
delete
-----------
2020-11-27


```php
delete($cookies): void
```

Deletes the given cookie(s).

$cookies can be either the name of the cookie, or an array of names.
     
     
     
get
-----------
2020-11-27


```php
get(string $name, $default = null):mixed
```

Returns of the $name cookie if set, or the default value otherwise.
     
   
   
     
has
-----------
2020-11-27


```php
has(string $name): bool
```
Returns whether the cookie with name=$name is set.
 

