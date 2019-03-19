[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)



The FileTool class
================
2019-03-19 --> 2019-03-19






Introduction
============

The FileTool class.



Class synopsis
==============


class <span class="pl-k">FileTool</span>  {

- Methods
    - public static [append](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/append.md)(?$msg, ?$file) : void
    - public static [cleanVerticalSpaces](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/cleanVerticalSpaces.md)(?$file, $maxConsecutiveBlankLines = 3) : void
    - public static [getNbLines](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/getNbLines.md)(?$file) : void
    - public static [getFileSize](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/getFileSize.md)(string $file, bool $humanize = false) : int | Ling\Bat\false in case of failure (file not existing for instance)
    - public static [split](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/split.md)(?$file, ?$lineNumber) : void
    - public static [cut](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/cut.md)(?$file, ?$startLine, ?$endLine, $replaceFile = false) : Ling\Bat\array, the two parts around (before and after) the cut as an array
    - public static [extract](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/extract.md)(?$file, array $slices, $replaceFile = false) : Ling\Bat\string, the extracted content
    - public static [insert](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/insert.md)(?$lineNumber, ?$content, ?$file) : void

}






Methods
==============

- [FileTool::append](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/append.md) &ndash; 
- [FileTool::cleanVerticalSpaces](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/cleanVerticalSpaces.md) &ndash; 
- [FileTool::getNbLines](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/getNbLines.md) &ndash; 
- [FileTool::getFileSize](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/getFileSize.md) &ndash; Returns the size in bytes of a given file.
- [FileTool::split](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/split.md) &ndash; Split a file in two parts, at the given lineNumber , and return the two parts.
- [FileTool::cut](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/cut.md) &ndash; Or actually do the cut in the file (if replaceFile is true).
- [FileTool::extract](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/extract.md) &ndash; Take a file, extract all the slices from it, and return the result.
- [FileTool::insert](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/insert.md) &ndash; Inserts the given content at the given lineNumber for the file.





Location
=============
Ling\Bat\FileTool


SeeAlso
==============
Previous class: [FileSystemTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool.md)<br>Next class: [HashTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/HashTool.md)<br>
