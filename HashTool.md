HashTool
=====================
2017-10-12



This class contains functions for manipulating hashes.




getHashByArray
-------------
2017-10-12



```php
str    getHashByArray ( arr:array )
```

Return a hash corresponding to the given array.






getRandomHash64
-------------
2017-12-12



```php
str    getRandomHash64 ()
```

Return a random hash of length 64.



passwordVerify
-------------
2018-01-11



```php
bool    passwordVerify (password, hash)
```


Return whether or not the given password matches the given hash.


passwordEncrypt
-------------
2018-01-11



```php
string    passwordEncrypt (password)
```


Return a hash corresponding to the given password.



Return whether or not the given password matches the given hash.






