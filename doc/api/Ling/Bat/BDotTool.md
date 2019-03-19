[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)



The BDotTool class
================
2019-03-19 --> 2019-03-19






Introduction
============

This was partially stolen from the bee framework.
https://github.com/lingtalfi/bee/blob/master/bee/modules/Bee/Bat/BdotTool.php



Class synopsis
==============


class <span class="pl-k">BDotTool</span>  {

- Methods
    - public static [getDotValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/getDotValue.md)(?$path, array $array, $default = null, &$found = false) : void
    - public static [hasDotValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/hasDotValue.md)(?$path, array $array) : bool
    - public static [setDotValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/setDotValue.md)(?$path, ?$replacement, ?&$array) : void
    - public static [unsetDotValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/unsetDotValue.md)(?$path, array &$array) : void
    - public static [walk](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/walk.md)(array &$a, ?$callback) : void
    - private static [doWalk](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/doWalk.md)(array &$a, \Closure $callback, $curPath = ) : void
    - private static [doGetDotValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/doGetDotValue.md)(array $paths, ?$array, ?$beeDot, $default = null, &$found = false) : void
    - private static [doGetValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/doGetValue.md)(?$path, array $array, $default = null, &$found = false) : void

}






Methods
==============

- [BDotTool::getDotValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/getDotValue.md) &ndash; 
- [BDotTool::hasDotValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/hasDotValue.md) &ndash; 
- [BDotTool::setDotValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/setDotValue.md) &ndash; Sets a value in an array.
- [BDotTool::unsetDotValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/unsetDotValue.md) &ndash; 
- [BDotTool::walk](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/walk.md) &ndash; 
- [BDotTool::doWalk](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/doWalk.md) &ndash; 
- [BDotTool::doGetDotValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/doGetDotValue.md) &ndash; 
- [BDotTool::doGetValue](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool/doGetValue.md) &ndash; 





Location
=============
Ling\Bat\BDotTool


SeeAlso
==============
Previous class: [ArrayTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool.md)<br>Next class: [CaseTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/CaseTool.md)<br>
