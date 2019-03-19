[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\FileSystemTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md)


FileSystemTool::mkdirDone
================



FileSystemTool::mkdirDone — Ensures that a directory exists, or throws an exception if something wrong happens.




Description
================


public static [FileSystemTool::mkdirDone](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkdirDone.md)(?$pathName, $mode = 511, $recursive = true) : bool




Ensures that a directory exists, or throws an exception if something wrong happens.

It uses the same arguments as the php native mkdir function.
bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource $context ]]] )


It is considered a success when the dir exists and is a dir (not a file or a link),
and there were no permissions errors.

It is considered a failure otherwise.


This method returns true in case of success, and false in case of failure.
If a link or a file resides at the location where you want to create the dir, this
method will not try to remove the existing link or file and will fail.




Parameters
================



Return values
================

Returns bool.


Exceptions thrown
================

- [Exception](http://php.net/manual/en/class.exception.php).&nbsp;







See Also
================

The [FileSystemTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md) class.

Previous method: [mkdir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkdir.md)<br>Next method: [mkfile](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkfile.md)<br>

