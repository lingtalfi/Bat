FileSystemTool
=====================
2015-10-07



This class contains functions for manipulating the filesystem.

Note: 
some examples use the a function, which comes from the [bigbang technique]( https://github.com/lingtalfi/universe/blob/master/planets/TheScientist/convention.portableAutoloader.eng.md ).
If you don't use bigbang, you can use var_dump as a replacement.




clearDir
-------------
2015-10-12

```php
void|bool    clearDir ( string:file, bool:throwEx = true )
```


Ensures that a directory exists and is empty.

It is considered a success if the directory exists and is empty, and a failure otherwise.

By default, the method throws an exception in case of failure.

If you set the throwEx flag to false, then this method will return true in case of success,
and false in case of failure.
     
     
     
     
     

getFileExtension
-----------
2015-10-09


```php
string    getFileExtension ( string:file )
```

Returns the extension of a file which path is given.
The behaviour of this method is described by the following table:


filename      |      extension returned
------------  | --------------------
hello.txt            |  txt
hello.tXT            |  tXT
hello.tar.gz         |  gz
.htaccess            |  \<empty string>
.htaccess.tar.gz     |  gz
hello                |  \<empty string>
.                    |  \<empty string>
..                   |  \<empty string>



```php
$f = '/path/to/myfile.jpg';
a(FileSystemTool::getFileExtension($f)); // jpg
```



mkdir
-----------
2015-10-07


```php
bool    mkdir ( string:pathName, octal:mode = 0777, bool:recursive = false, resource:context? )
```


This does basically the same job as php's [mkdir](http://php.net/manual/en/function.mkdir.php) function (it also has the same signature by the way), 
but the difference is that the FileSystemTool::mkdir method
returns false if the dir couldn't be created, and true if the
dir could be created or already existed.
No warning is triggered if a problem occurs.

This behaviour allows us to write compact and flexible code:


```php
<?php


use Bat\FileSystemTool;

require_once 'bigbang.php';


$dir = 'dddd';
if (FileSystemTool::mkdir($dir)) {
    throw new \Exception("oops");
}
// here we know for sure that the dir $dir exists

```
 

More info about [bigbang oneliner here]( https://github.com/lingtalfi/universe/blob/master/planets/TheScientist/convention.portableAutoloader.eng.md ).



remove
-----------
2015-10-12


```php
void|bool        remove ( string:file, bool:throwEx = true )
```


Removes an entry from the filesystem.

The entry can be:
- a link, then the link only is removed (not the target)
- a file, then the file is removed
- a directory, the the directory is removed recursively

It is considered a success when the entry doesn't exist on the filesystem at the end,
and a failure otherwise.
By default, the function throws an exception in case of failure.
If you set the throwEx flag to false, then this method will return true in case of success,
and false in case of failure.



There are two basic workflows: 

- straight to the point (default)
- flexible (throwEx=false)


```php


/**
 * Case 1: straight to the point
 */
FileSystemTool::remove('doo');
// now entry doo doesn't exist on your file system (or you get an exception)


/**
 * Case 2: flexible approach
 */
if (false === FileSystemTool::remove('doo', false)) {
    // here you get the opportunity to handle the failure manually
}

```



touchDone
-----------
2015-10-07


```php
void        touchDone ( string:fileName ) 
```

This method acts like the php's [touch function](http://php.net/manual/en/function.touch.php) and has the same signature.
The only difference is that FileSystemTool::touchDone creates intermediary directories if necessary,
and throws an exception in case something goes wrong.

This allows us to do a one liner, and be ensured that past that line the file has been touched (hence the Done suffix):
  
```php
$file = __DIR__ . "/pou/bam.php";
FileSystemTool::touchDone($file);
// now, we know that $file exists no matter what  
```  





