[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\FileTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool.md)


FileTool::extract
================



FileTool::extract — Take a file, extract all the slices from it, and return the result.




Description
================


public static [FileTool::extract](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/extract.md)(?$file, array $slices, $replaceFile = false) : Ling\Bat\string, the extracted content




Take a file, extract all the slices from it, and return the result.
It will also save the file with the actual changes done, if replaceFile is true.

Each slice is an array:
- 0: startLine of the part to cut
- 1: endLine of the part to cut


Slices must not overlap.




Parameters
================



Return values
================

Returns Ling\Bat\string, the extracted content.








See Also
================

The [FileTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool.md) class.

Previous method: [cut](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/cut.md)<br>Next method: [insert](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool/insert.md)<br>

