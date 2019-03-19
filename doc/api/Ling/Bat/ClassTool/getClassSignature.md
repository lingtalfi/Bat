[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\ClassTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool.md)


ClassTool::getClassSignature
================



ClassTool::getClassSignature — Returns the class signature of the given $class.




Description
================


public static [ClassTool::getClassSignature](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getClassSignature.md)([\ReflectionClass](http://php.net/manual/en/class.reflectionclass.php) $class) : string




Returns the class signature of the given $class.

Example:

- class Bat
- abstract class BaseNodeTreeBuilder implements NodeTreeBuilderInterface
- final class Imaginary implements Dream, Monday
- class ArrayRefResolverException extends \Exception implements \Throwable


Note: short class names are used only,
and if the class is not user defined (for instance the \Exception class),
the class name is prefixed with the backslash (\).




Parameters
================


- class

    


Return values
================

Returns string.








See Also
================

The [ClassTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool.md) class.

Previous method: [collectAbstractAncestors](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/collectAbstractAncestors.md)<br>Next method: [getMethodContent](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ClassTool/getMethodContent.md)<br>

