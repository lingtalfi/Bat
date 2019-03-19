[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\StringTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool.md)


StringTool::cutNumericalSuffix
================



StringTool::cutNumericalSuffix — 




Description
================


public static [StringTool::cutNumericalSuffix](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/cutNumericalSuffix.md)(?$str) : void




Take a string, and return an array containing two entries:

- the string without the numerical suffix
- the numerical suffix or false if the last chars are not numerical

For instance,
hello68 => [hello, 68]
hello => [hello, false]
hello-78.79 => [hello78., 79]
123 => ["", 123]




Parameters
================



Return values
================

Returns void.








See Also
================

The [StringTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool.md) class.

Previous method: [camelCase2Constant](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/camelCase2Constant.md)<br>Next method: [htmlAttributes](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/htmlAttributes.md)<br>

