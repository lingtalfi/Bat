[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\FileTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool.md)


FileTool::cut
================



FileTool::cut — Or actually do the cut in the file (if replaceFile is true).




Description
================


public static [FileTool::cut](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/cut.md)(?$file, ?$startLine, ?$endLine, $replaceFile = false) : Ling\Bat\array, the two parts around (before and after) the cut as an array




Cut a file from line startLine to endLine, and either returns two parts (if replaceFile is false):
- the part before the startLine,
- the part after the endLine

Or actually do the cut in the file (if replaceFile is true).




Parameters
================



Return values
================

Returns Ling\Bat\array, the two parts around (before and after) the cut as an array.








See Also
================

The [FileTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool.md) class.

Previous method: [split](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/split.md)<br>Next method: [extract](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/extract.md)<br>

