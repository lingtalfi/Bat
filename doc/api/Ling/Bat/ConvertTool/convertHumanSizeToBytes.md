[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\ConvertTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConvertTool.md)


ConvertTool::convertHumanSizeToBytes
================



ConvertTool::convertHumanSizeToBytes — Returns a number of bytes by converting the given $humanSize expression.




Description
================


public static [ConvertTool::convertHumanSizeToBytes](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConvertTool/convertHumanSizeToBytes.md)(?$humanSize) : int




Returns a number of bytes by converting the given $humanSize expression.

The $humanSize expression uses a human intuitive notation. All examples below are valid $humanSize expressions:

- 48          // 48 bytes
- 48b         // 48 bytes
- 48 b        // 48 bytes
- 48k         // 48 kilobytes
- 48 m        // 48 megabytes
- 2.6 M       // 2.6 megabytes
- 1.4 g       // 1.4 gigabytes
- 1.4 t       // 1.4 terabyte
- 1.4 p       // 1.4 petabyte
- 1.4 e       // 1.4 exabyte
- 1.4 z       // 1.4 zettabyte
- 1.4 y       // 1.4 yottabyte


The $humanSize expression is composed of two elements:

- a number
- a unit

The number represents the size.
The number is any number. Decimal numbers are accepted if the dot (.) or the comma (,) is used as a separator.

The unit represents the unit for the given size.
If omitted, it defaults to bytes.
All units are multiple of 1024 (i.e. not 1000).
A unit is always expressed with one (and only one letter), which can be either lower case or upper case.
It's possible to add whitespace(s) between the number and the unit components.
All possible units are exposed in the example above.




Parameters
================


- humanSize

    


Return values
================

Returns int.








See Also
================

The [ConvertTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConvertTool.md) class.

Previous method: [convertHexColorToRgb](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConvertTool/convertHexColorToRgb.md)<br>

