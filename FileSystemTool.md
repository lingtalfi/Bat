FileSystemTool
=====================
2015-10-07



This class contains functions for manipulating the filesystem.

Note: 
some examples use the a function, which comes from the [bigbang technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md ).
If you don't use bigbang, you can use var_dump as a replacement.




cleanDirBubble
-------------
2018-02-27

```php
void    cleanDirBubble ( string:dir )
```

Check if the given dir is empty (i.e. does not contain any file/dir/link).
If this is the case, then remove the dir and cleanDirBubble the parent dir
recursively until the parent dir is not empty.

     



clearDir
-------------
2015-10-12 --> 2017-06-22

```php
void|bool    clearDir ( string:file, bool:throwEx = true, bool:abortIfSymlink=true )
```


Ensures that a directory exists and is empty.

It is considered a success if the directory exists and is empty, and a failure otherwise.

By default, the method throws an exception in case of failure.

If you set the throwEx flag to false, then this method will return true in case of success,
and false in case of failure.

By default, if the target is a symlink, the process will be aborted.
If you want to clear the symlink dir, set the $abortIfSymlink flag to false.
     
     

copyDir
-------------     
2015-10-20

```php
bool        copyDir ( str:srcDir, str:targetDir, bool:preservePerms = false, array:&errors = [] )
```
     
Copies a directory (recursively) to a given location.


copyFile
-------------     
2017-05-11


```php
bool        copyFile ( str:srcDir, str:targetDir )
```

Copy a file.



countFiles
-------------     
2018-02-27


```php
int        countFiles ( str:srcDir )
```

Returns the number of files of a given dir.


     
existsUnder
-------------     
2015-10-27

```php
bool        existsUnder ( str:file, str:dir )
```
     
     
Returns true only if:

- dir exists
- file exists and is located under the dir

This method automatically resolves paths (things like ../../ are being resolved) before executing the test.
This method comes handy when you want to check for a path that comes from an (untrusted) user.




fileGenerator
-------------     
2016-02-13

```php
callable:generator      fileGenerator ( str:file, bool:ignoreTrailingNewLines=true )
```
     
Returns a generator function, which can iterate over the lines of the given file.


### Example

```php

$f = "/path/to/data.txt";
$gen = FileSystemTool::fileGenerator($f);
foreach ($gen() as $v) {
    a($v);
}

```


filePerms
------------
2015-11-04
     
See [PermTool::filePerms](https://github.com/lingtalfi/Bat/blob/master/PermTool.md#fileperms)
     
     

getFileExtension
-----------
2015-10-09


```php
string    getFileExtension ( string:file )
```

Returns the extension of a file which path is given.
The extension in this [fileName nomenclature](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.fileName.eng.md)



```php
$f = '/path/to/myfile.jpg';
a(FileSystemTool::getFileExtension($f)); // jpg
```
     
     

getFileName
-----------
2015-10-25


```php
string    getFileName ( string:file )
```

Returns the [file name](https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.fileName.eng.md)
of a file which path is given.



```php
$f = '/path/to/myfile.jpg';
a(FileSystemTool::getFileName($f)); // myfile
```
 
     

getFileSize
-----------
2015-10-25


```php
int|false    getFileSize ( string:file )
```

Returns the size in bytes of a given file.
The file can be an url starting with http:// https://, or a filesystem file.




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
 

More info about [bigbang oneliner here]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md ).



mkdirDone
-----------
2015-10-17


```php
bool    mkdirDone ( string:pathName, octal:mode = 0777, bool:recursive = false, resource:context? )
```


This does basically the same job as php's [mkdir](http://php.net/manual/en/function.mkdir.php) function (it also has the same signature by the way), 
but the difference is that the FileSystemTool::mkdirDone method
throws an exception if the dir couldn't be created, and true if the
dir could be created or already existed.

This behaviour allows us to write a one liner:


```php

FileSystemTool::mkdirDone($dir);
// here we know for sure that the dir $dir exists
```





mkfile
-----------
2015-12-15


```php
bool    mkfile ( str:pathName, str:data="", octal:dirMode = 0777, int:flags=0 )
```

Creates a file, and the intermediary directories if necessary
Returns true if the file exists when the method has been executed.
Returns false if the file couldn't be created.


### Example

```php
<?php


use Bat\FileSystemTool;

require_once "bigbang.php";


$f = "/tmp/do/re/mi.txt";
a(FileSystemTool::mkfile($f, "hello"));


```




noEscalating
-----------
2017-06-03


```php
str    noEscalating (string:uri)
```

Returns a file path which won't be able to escalate into parent directories (removing the expression ".." basically).





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




rename
-----------
2018-02-26


```php
bool        rename ( string:source, string:destination )
```


Will rename the source file to the destination file,
and create necessary subdirectories.

Returns the same as php's native rename: a boolean indicating whether or not the operation
was successful.



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





tempDir
-----------
2016-12-23


```php
false|string        tempDir ( string:dir=null, string:prefix=null ) 
```

Creates a temporary directory and returns its path,
or false in case of failure.

The "dir" argument can be used to specify the parent directory.
If not specified, the default temporary directory will be used.

The "prefix" argument is a prefix for the created tmp directory name.
 
  
```php
a(FileSystemTool::tempDir()); // /private/var/tmp/cTzJZe
a(FileSystemTool::tempDir(__DIR__)); // /Users/me/webproject/www/XJEubG
a(FileSystemTool::tempDir(null, '/private/var/tmp/xxxijtKdi'));  
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





