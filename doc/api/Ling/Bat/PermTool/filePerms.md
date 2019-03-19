[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\PermTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool.md)


PermTool::filePerms
================



PermTool::filePerms — Gets file permissions.




Description
================


public static [PermTool::filePerms](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/filePerms.md)(?$file, $unix = true) : void




Gets file permissions.

Returns:
- false in case of failure
- if true === unix, str:permissions       ( -rw-r--r-- )
- if false === unix, str:permissions      ( 1777, 0644, ...)




Parameters
================



Return values
================

Returns void.








See Also
================

The [PermTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool.md) class.

Previous method: [chperms](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/chperms.md)<br>Next method: [applyRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/applyRecursive.md)<br>

