[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)



The PermTool class
================
2019-03-19 --> 2019-03-19






Introduction
============

The PermTool class.
LingTalfi 2016-06-16



Class synopsis
==============


class <span class="pl-k">PermTool</span>  {

- Methods
    - public static [chmod](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/chmod.md)(?$target, ?$mode, $isRecursive = true) : bool
    - public static [chown](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/chown.md)(?$target, ?$owner, $ownerGroup = null, $isRecursive = true) : bool
    - public static [chperms](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/chperms.md)(?$target, ?$mode, ?$owner, $ownerGroup = null, $isRecursive = true) : bool
    - public static [filePerms](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/filePerms.md)(?$file, $unix = true) : void
    - private static [applyRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/applyRecursive.md)(?$path, callable $fn) : bool

}






Methods
==============

- [PermTool::chmod](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/chmod.md) &ndash; 
- [PermTool::chown](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/chown.md) &ndash; 
- [PermTool::chperms](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/chperms.md) &ndash; Combination of chmod and chown.
- [PermTool::filePerms](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/filePerms.md) &ndash; Gets file permissions.
- [PermTool::applyRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/PermTool/applyRecursive.md) &ndash; 





Location
=============
Ling\Bat\PermTool


SeeAlso
==============
Previous class: [ObTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ObTool.md)<br>Next class: [RandomTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/RandomTool.md)<br>
