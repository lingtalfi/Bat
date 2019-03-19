[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\FileSystemTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md)


FileSystemTool::mkdir
================



FileSystemTool::mkdir — Ensures that a directory exists.




Description
================


public static [FileSystemTool::mkdir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkdir.md)(?$pathName, $mode = 511, $recursive = true) : void




Ensures that a directory exists.

It uses the same arguments as the php native mkdir function.
bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource $context ]]] )


It is considered a success when the dir exists and is a dir (not a file), and there were no permissions errors.

It is considered a failure otherwise.


This method returns true in case of success, and false in case of failure.
If a link or a file resides at the location where you want to create the dir, this
method will not try to remove the existing link or file and will fail.




Parameters
================



Return values
================

Returns void.








See Also
================

The [FileSystemTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md) class.

Previous method: [fileGenerator](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/fileGenerator.md)<br>Next method: [mkdirDone](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkdirDone.md)<br>

