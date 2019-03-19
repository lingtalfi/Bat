[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\FileTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool.md)


FileTool::insert
================



FileTool::insert — Inserts the given content at the given lineNumber for the file.




Description
================


public static [FileTool::insert](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/insert.md)(?$lineNumber, ?$content, ?$file) : void




Inserts the given content at the given lineNumber for the file.
If the given lineNumber is greater than the number of lines in the file,
the content will be appended to the existing file, prefixed with a newline.




Parameters
================



Return values
================

Returns void.








See Also
================

The [FileTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool.md) class.

Previous method: [extract](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/extract.md)<br>

