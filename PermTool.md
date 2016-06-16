PermTool
=====================
2016-06-16



This class contains functions for manipulating permissions.




Note: 
some examples require a bigbang script and use the **a** function. More on this here in the [bigbang technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md ).



chmod
-----------
2016-06-16

Recursive version of php chmod.


```php
bool chmod( str:target, str|octal:mode, bool:isRecursive=true )
```

Change the permissions of the given target.
Returns true in case of success, and false in case of failure.




Examples:

```php
<?php


use Bat\PermTool;

require_once "bigbang.php"; // start the local universe (https://github.com/lingtalfi/Observer/blob/master/article/article.planetReference.eng.md)


// the line below set the permissions of the /my/app/www directory to 0777 (recursively)
a(PermTool::chmod("/my/app/www", 0777)); // true|false
```





chown
-----------
2016-06-16

Recursive version of php chown.


```php
bool chown( str:target, str:owner, str:ownerGroup=null, bool:isRecursive=true )
```

Change the owner and owner group of the given target.
Returns true in case of success, and false in case of failure.

If the ownerGroup is set to null (by default), then no owner group will be applied.


Examples:

```php
<?php


use Bat\PermTool;

require_once "bigbang.php"; // start the local universe (https://github.com/lingtalfi/Observer/blob/master/article/article.planetReference.eng.md)


// the line below applies the www-data:www-data permissions on directory /my/app/www (recursively)
a(PermTool::chown("/my/app/www", 'www-data', 'www-data')); // true|false
```


```php
<?php


use Bat\PermTool;

require_once "bigbang.php"; // start the local universe (https://github.com/lingtalfi/Observer/blob/master/article/article.planetReference.eng.md)


// the line below make the /my/app/www directory be owned by the www-data user (recursively).
a(PermTool::chown("/my/app/www", 'www-data', null)); // true|false
```









chperms
-----------
2016-06-16

Combination of recursive chmod and chown.


```php
bool chperms( str:target, str|octal:mode, str:owner, str:ownerGroup=null, bool:isRecursive=true )
```

Change the permissions and owner/ownerGroup of the given target.
Returns true in case of success, and false in case of failure.




Examples:

```php
<?php


use Bat\PermTool;

require_once "bigbang.php"; // start the local universe (https://github.com/lingtalfi/Observer/blob/master/article/article.planetReference.eng.md)


// the line below set the permissions of the /my/app/www directory to 0777 (recursively), and make that dir be owned by www-data:www-data
a(PermTool::chperms("/my/app/www", 0777, 'www-data', 'www-data')); // true|false
```




filePerms
------------
2015-11-04
     
     
```php     
false|str:perms     filePerms(str:file, bool:unix=true)     
```     
     
Gets file permissions.

Returns:        
- false in case of failure
- if true === unix, str:permissions       ( -rw-r--r-- )
- if false === unix, str:permissions      ( 1777, 0644, ...)

     




