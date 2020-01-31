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

If the file path has multiple extensions, only the last one will be returned.
If the file path has no extension or an empty extension, the empty string will be returned.


Examples:

- /www/htdocs/inc/lib.inc.php    --> "php"
- /path/emptyextension.          --> ""
- /path/noextension              --> ""



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
of a file which path is given, which is the file name without the last extension.



If the file path has multiple extensions, only the last one will be cut off.

Examples:

- /www/htdocs/inc/lib.inc.php    --> "lib.inc"
- /path/emptyextension.          --> "emptyextension"
- /path/noextension              --> "noextension"
     
     

```php
$f = '/path/to/myfile.jpg';
a(FileSystemTool::getFileName($f)); // myfile
```
 
     

getFileSize
-----------
2015-10-25


See FileTool::getFileSize




getRelativePath
-----------
2018-06-15


string|false        getRelativePath( string:absolutePath, string:rootDir )


Return the relative path from rootDir to absolutePath, or false if the absolutePath
is not contained in (a children of) rootDir.



isDirectoryTraversalSafe
-----------
2019-10-16


```php
bool        isDirectoryTraversalSafe( string:file, string:rootDir, bool:checkFileExists )
```


Returns whether the given file and is under the given rootDir.
If the $checkFileExists is set, also checks whether the file exists.



isValidFilename
-----------
2020-01-31


```php
bool        isValidFilename( string:filename)
```


Returns whether the given filename is considered valid.

A filename is considered valid only if all conditions below are fulfilled:

- the filename is different than "..".
- the filename doesn't contain one of the following characters: /?*:;{}\



mkdir
-----------
2015-10-07


```php
bool    mkdir ( string:pathName, octal:mode = 0777, bool:recursive = true, resource:context? )
```


This does basically the same job as php's [mkdir](http://php.net/manual/en/function.mkdir.php) function (it also has the same signature by the way), 
but the difference is that the FileSystemTool::mkdir method
returns false if the dir couldn't be created, and true if the
dir could be created or already existed.

This behaviour allows us to write compact and flexible code:


```php
<?php


use Ling\Bat\FileSystemTool;

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


use Ling\Bat\FileSystemTool;

require_once "bigbang.php";


$f = "/tmp/do/re/mi.txt";
a(FileSystemTool::mkfile($f, "hello"));


```



mkTmpFile
-----------
2018-06-15


```php
string:path    mkTmpFile ( str:content, str:prefix=null )
```

Creates a temporary file with the given content, and return its path.


### Example

```php
<?php

$path = FileSystemTool::mkTmpFile("I'm the content of the file");
a($path);  // /private/var/folders/sd/8m3gr23x1812c8_fddkwtk740000gn/T/BatGCcMzM

```




move
-----------
2018-06-15

Alias for rename.



moveToDir
-----------
2018-06-15


```php
bool    moveToDir (string:filePath, string:destDir)
```

Move the file filePath to the directory destDir.







resolveTilde
-----------
2019-04-02


```php
str    resolveTilde (string:path)
```

Returns the given $path with the tilde resolved (to the user home directory).





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




removeExtension
-----------
2019-02-19 -> 2019-04-24


```php
string        removeExtension(string:file)
```

Removes the (last) file extension from the given $file and returns the result.

If the file starts with a dot (like .htaccess), what follows the first dot is not considered as an extension.


Examples:

- .htaccess => .htaccess
- file.md => file
- file.tpl.php => file.tpl


The following code: 

```php
$file = "/komin/jin_site_demo/www-doc/api/DocTools/TemplateWizard/TemplateWizard/getInserts.md";
a(FileSystemTool::removeExtension($file));

```

Will output:


```html
string(82) "/komin/jin_site_demo/www-doc/api/DocTools/TemplateWizard/TemplateWizard/getInserts"

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





