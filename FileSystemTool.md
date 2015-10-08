FileSystemTool
=====================
2015-10-07



This class contains functions for manipulating the filesystem.





mkdir
-----------

This does basically the same job as php's [mkdir](http://php.net/manual/en/function.mkdir.php) function (
it also has the same signature by the way), 
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

