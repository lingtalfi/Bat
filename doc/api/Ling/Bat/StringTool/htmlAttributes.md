[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\StringTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool.md)


StringTool::htmlAttributes
================



StringTool::htmlAttributes — Returns an html attributes string based on the given array.




Description
================


public static [StringTool::htmlAttributes](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/htmlAttributes.md)(array $attributes, $keyPrefix = ) : void




Returns an html attributes string based on the given array.
Support arguments with just value, like checked for example.

Also, if an argument value is null, it is omitted;
this behaviour might be useful in this case where we define default attributes values,
then the client can unset them by setting a null value.


The $keyPrefix allows us to prefix with "data-" for instance.




Parameters
================



Return values
================

Returns void.








See Also
================

The [StringTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool.md) class.

Previous method: [cutNumericalSuffix](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/cutNumericalSuffix.md)<br>Next method: [getPlural](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/getPlural.md)<br>

