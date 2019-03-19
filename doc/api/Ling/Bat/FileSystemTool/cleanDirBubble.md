[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\FileSystemTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md)


FileSystemTool::cleanDirBubble
================



FileSystemTool::cleanDirBubble — Check if the given dir is empty (i.e.




Description
================


public static [FileSystemTool::cleanDirBubble](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/cleanDirBubble.md)(?$dir) : void




Check if the given dir is empty (i.e. does not contain any file/dir/link).
If this is the case, then remove the dir and cleanDirBubble the parent dir
recursively until the parent dir is not empty.




Parameters
================


- dir

    


Return values
================

Returns void.








See Also
================

The [FileSystemTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md) class.

Next method: [clearDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/clearDir.md)<br>

