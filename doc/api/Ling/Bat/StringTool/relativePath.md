[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\StringTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool.md)


StringTool::relativePath
================



StringTool::relativePath — Drop the absoluteBaseDir string in front of the absolutePath.




Description
================


public static [StringTool::relativePath](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/relativePath.md)(?$absoluteBaseDir, ?$absolutePath, $default = null) : string | Ling\Bat\mixed, a relative path, starting with a slash (at least on linux,




Drop the absoluteBaseDir string in front of the absolutePath.

If it's not in front, the returned value depends on the default parameter:
- if default is null, the absolutePath is returned
- else default is returned




Parameters
================


- absoluteBaseDir

    

- absolutePath

    


Return values
================

Returns string | Ling\Bat\mixed, a relative path, starting with a slash (at least on linux,.
it will probably NOT WORK on windows),
or the $default parameter value otherwise.







See Also
================

The [StringTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool.md) class.

Previous method: [indent](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/indent.md)<br>Next method: [removeAccents](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/removeAccents.md)<br>

