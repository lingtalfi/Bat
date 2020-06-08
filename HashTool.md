HashTool
=====================
2017-10-12 -> 2020-06-08



This class contains functions for manipulating hashes.




getHashByArray
-------------
2017-10-12



```php
str    getHashByArray ( arr:array )
```

Return a hash corresponding to the given array.


getHashByFile
-------------
2020-06-08



```php
str    getHashByFile ( arr:file )
```

Returns the hash for the given file.

Note: this can be slow on big files like videos...

This method was meant to be used with small files.
     
     




getPasswordHashAlgorithm
-------------
2019-10-03



```php
int    getPasswordHashAlgorithm ( str:algoName )
```

Returns the algo integer which corresponds to the given algoName, and to pass to the password_hash function
(https://www.php.net/manual/en/function.password-hash.php).








getRandomHash64
-------------
2017-12-12



```php
str    getRandomHash64 (int length = 64)
```

Return a random hash of the given length (default=64).



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






