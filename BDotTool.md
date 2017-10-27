BDotTool
=====================
2017-10-27



This class contains functions for interacting with arrays using the bdot notation.





    
getDotValue
-------------
2017-10-27


```php
mixed getDotValue ( str:path, array:array, mixed:default=null, bool &found=false)
```

Return the value pointed by path in the given array, or the default value if not found.
Also positions the found flag to whether the value was actually found or not.



    
hasDotValue
-------------
2017-10-27


```php
bool hasDotValue ( str:path, array:array )
```

Return whether or not the value pointed by path exists.


setDotValue
-------------
2017-10-27


```php
void setDotValue ( str:path, mixed:replacement, array:array )
```

Sets a value in an array.
Note: if the key does not exist, it will be created.
Also, if a key along the path is not an array, it will be overwritten and become an array.



unsetDotValue
-------------
2017-10-27


```php
void unsetDotValue ( str:path, array:array )
```

Unset the value from the given array if it exists.



walk
-------------
2017-10-27


```php
void walk ( array:array, callable:callback )
```

Applies the given callback to every element of the array.
The callback receives the value and has the opportunity to change it via the reference;
it also receives the current key and the current dotPath.

- callback ( &?value, key, dotPath )


