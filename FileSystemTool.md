FileSystemTool
=====================
2015-10-07



This class contains functions for manipulating the filesystem.





getFileExtension
-----------

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





mkdir
-----------

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





touchDone
-----------

This method acts like the php's [touch function](http://php.net/manual/en/function.touch.php) and has the same signature.
The only difference is that FileSystemTool::touchDone creates intermediary directories if necessary,
and throws an exception in case something goes wrong.

This allows us to do a one liner, and be ensured that past that line the file has been touched (hence the Done suffix):
  
```php
$file = __DIR__ . "/pou/bam.php";
FileSystemTool::touchDone($file);
// now, we know that $file exists no matter what  
```  





