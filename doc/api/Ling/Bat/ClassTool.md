[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)



The ClassTool class
================
2019-03-19 --> 2019-03-19






Introduction
============

The ClassTool class.



Class synopsis
==============


class <span class="pl-k">ClassTool</span>  {

- Methods
    - public static [getAbstractAncestors](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getAbstractAncestors.md)([\ReflectionClass](http://php.net/manual/en/class.reflectionclass.php) $class) : [ReflectionClass[]](http://php.net/manual/en/class.reflectionclass.php)
    - private static [collectAbstractAncestors](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/collectAbstractAncestors.md)([\ReflectionClass](http://php.net/manual/en/class.reflectionclass.php) $class, array &$collection) : void
    - public static [getClassSignature](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getClassSignature.md)([\ReflectionClass](http://php.net/manual/en/class.reflectionclass.php) $class) : string
    - public static [getMethodContent](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getMethodContent.md)(?$class, ?$method) : string | false
    - public static [getMethodInnerContent](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getMethodInnerContent.md)(?$class, ?$method) : void
    - public static [getMethodSignature](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getMethodSignature.md)([\ReflectionMethod](http://php.net/manual/en/class.reflectionmethod.php) $method) : void
    - public static [getMethodNames](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getMethodNames.md)(?$class, array $filter = []) : array
    - public static [getShortName](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getShortName.md)(?$object) : Ling\Bat\string, the short name for the given class
    - public static [rewriteMethodContent](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/rewriteMethodContent.md)(?$class, ?$method, ?$func) : void

}






Methods
==============

- [ClassTool::getAbstractAncestors](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getAbstractAncestors.md) &ndash; Returns an array of all abstract ancestors classes (\ReflectionClass) for the given $class.
- [ClassTool::collectAbstractAncestors](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/collectAbstractAncestors.md) &ndash; 
- [ClassTool::getClassSignature](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getClassSignature.md) &ndash; Returns the class signature of the given $class.
- [ClassTool::getMethodContent](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getMethodContent.md) &ndash; 
- [ClassTool::getMethodInnerContent](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getMethodInnerContent.md) &ndash; 
- [ClassTool::getMethodSignature](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getMethodSignature.md) &ndash; 
- [ClassTool::getMethodNames](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getMethodNames.md) &ndash; 
- [ClassTool::getShortName](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getShortName.md) &ndash; 
- [ClassTool::rewriteMethodContent](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/rewriteMethodContent.md) &ndash; 





Location
=============
Ling\Bat\ClassTool


SeeAlso
==============
Previous class: [CaseTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/CaseTool.md)<br>Next class: [ConsoleTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ConsoleTool.md)<br>
