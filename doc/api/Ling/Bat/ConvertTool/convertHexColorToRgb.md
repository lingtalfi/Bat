[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\ConvertTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConvertTool.md)


ConvertTool::convertHexColorToRgb
================



ConvertTool::convertHexColorToRgb — Returns an array of rgb colors from the given $hexColor.




Description
================


public static [ConvertTool::convertHexColorToRgb](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConvertTool/convertHexColorToRgb.md)(string $hexColor) : array




Returns an array of rgb colors from the given $hexColor.

The returned array has the following structure.
- 0: red
- 1: green
- 2: blue

The given $hexColor can optionally be prefixed with a pound symbol (#).
The hexColor string must be exactly 6 chars long, or the BatException is thrown.




Parameters
================


- hexColor

    


Return values
================

Returns array.


Exceptions thrown
================

- [BatException](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/Exception/BatException.md).&nbsp;







See Also
================

The [ConvertTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConvertTool.md) class.

Previous method: [convertBytes](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConvertTool/convertBytes.md)<br>Next method: [convertHumanSizeToBytes](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConvertTool/convertHumanSizeToBytes.md)<br>

