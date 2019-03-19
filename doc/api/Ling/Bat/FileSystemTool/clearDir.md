[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\FileSystemTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md)


FileSystemTool::clearDir
================



FileSystemTool::clearDir — Ensures that a directory exist and is empty.




Description
================


public static [FileSystemTool::clearDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/clearDir.md)(?$file, $throwEx = true, $abortIfSymlink = true) : void




Ensures that a directory exist and is empty.

It is considered a success if the directory exists and is empty, and a failure otherwise.

By default, the method throws an exception in case of failure.

If you set the throwEx flag to false, then this method will return true in case of success,
and false in case of failure.


By default, if the target is a symlink, the process will be aborted.
If you want to clear the symlink dir, set the $abortIfSymlink flag to false.




Parameters
================



Return values
================

Returns void.








See Also
================

The [FileSystemTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md) class.

Previous method: [cleanDirBubble](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/cleanDirBubble.md)<br>Next method: [copyDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/copyDir.md)<br>

