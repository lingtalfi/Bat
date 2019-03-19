[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\FileSystemTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md)


FileSystemTool::filePerms
================



FileSystemTool::filePerms — Gets file permissions.




Description
================


public static [FileSystemTool::filePerms](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/filePerms.md)(?$file, $unix = true) : void




Gets file permissions.

Returns:
- false in case of failure
- if true === unix, str:permissions       ( -rw-r--r-- )
- if false === unix, str:permissions      ( 1777, 0644, ...)




Parameters
================



Return values
================

Returns void.








See Also
================

The [FileSystemTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md) class.

Previous method: [existsUnder](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/existsUnder.md)<br>Next method: [getFileExtension](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/getFileExtension.md)<br>

