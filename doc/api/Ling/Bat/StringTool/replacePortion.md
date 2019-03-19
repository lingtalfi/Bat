[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\StringTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool.md)


StringTool::replacePortion
================



StringTool::replacePortion — Cuts a portion of a string, and replaces it with a replacement string.




Description
================


public static [StringTool::replacePortion](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/replacePortion.md)(?$string, ?$start, ?$length, ?$replacement) : string




Cuts a portion of a string, and replaces it with a replacement string.




Parameters
================


- start

    the position where to start the cut.
If start is bigger than the string's length,
then the text will be inserted at the end of the string.

- length

    the length of the cut

- replacement

    the replacement string


Return values
================

Returns string.








See Also
================

The [StringTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool.md) class.

Previous method: [removeAccents](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/removeAccents.md)<br>Next method: [split](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/split.md)<br>

