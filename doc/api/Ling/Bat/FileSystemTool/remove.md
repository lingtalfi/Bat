[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\FileSystemTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md)


FileSystemTool::remove
================



FileSystemTool::remove — Removes an entry from the filesystem.




Description
================


public static [FileSystemTool::remove](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/remove.md)(?$file, $throwEx = true) : void




Removes an entry from the filesystem.
The entry can be:

- a link, then the link only is removed (not the target)
- a file, then the file is removed
- a directory, the the directory is removed recursively

It is considered a success when the entry doesn't exist on the filesystem at the end,
and a failure otherwise.

By default, the method throws an exception in case of failure.

If you set the throwEx flag to false, then this method will return true in case of success,
and false in case of failure.




Parameters
================



Return values
================

Returns void.








See Also
================

The [FileSystemTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md) class.

Previous method: [noEscalating](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/noEscalating.md)<br>Next method: [removeExtension](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/removeExtension.md)<br>

