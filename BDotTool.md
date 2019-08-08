BDotTool
=====================
2017-10-27



This class contains functions for interacting with arrays using the
[bdot notation](https://github.com/karayabin/universe-snapshot/blob/master/universe/Ling/Bat/doc/bdot-notation.md).





    
getDotValue
-------------
2017-10-27


```php
mixed getDotValue ( str:path, array:array, mixed:default=null, bool &found=false)
```

Return the value pointed by path in the given array, or the default value if not found.
Also positions the found flag to whether the value was actually found or not.




    
getPathComponents
-------------
2019-08-08


```php
array getPathComponents ( str:path, bool:keepEscapedDots=true)
```

Returns an array containing the components of the given path.

Escaped dots are returned as is by default, but this method can unescape them on the fly
by setting the keepEscapedDots option to false.


Example:
```php
a(BDotTool::getPathComponents("my"));
a(BDotTool::getPathComponents("my.one"));
a(BDotTool::getPathComponents("my.one\.two.three"));
a(BDotTool::getPathComponents("my.one\.two.three", false));

```

Will output:

```html
array(1) {
  [0] => string(2) "my"
}

array(2) {
  [0] => string(2) "my"
  [1] => string(3) "one"
}

array(3) {
  [0] => string(2) "my"
  [1] => string(8) "one\.two"
  [2] => string(5) "three"
}

array(3) {
  [0] => string(2) "my"
  [1] => string(7) "one.two"
  [2] => string(5) "three"
}
```




    
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


