ClassTool
=====================
2016-12-22 -> 2020-07-09



This class contains functions for helping with classes.



executePhpMethod (aka smart php method call)
-----------------
2019-07-04


```php
mixed   executePhpMethod ( str:expr )
```

Executes a php method and return the result.
For convenience, developers can refer to this method call as a "smart php method call".

The given $phpMethod must have one of the following format (or else an exception will be thrown):

- $class::$method
- $class::$method ( $args )
- $class->$method
- $class->$method ( $args )


Note that the first two forms refer to a static method call, while the last two forms refer to a method call on
an instance (instantiation is done by this method).


With:

- $class: the full class name (example: Ling\Bat)
- $method: the name of the method to execute
- $args: a list of arguments written with smartcode notation (see SmartCodeTool class for more details).
            Note: we can write arguments in php style, as the php argument notation is a subset of the smartcode notation.

    
     

Example:



The following code: 
```php
class A
{
    public function hello()
    {
        return "hello";
    }

    public function returnArgs()
    {

        return func_get_args();
    }
}

a(ClassTool::executePhpMethod("A->hello"));
a(ClassTool::executePhpMethod("A->hello()"));
a(ClassTool::executePhpMethod("A->returnArgs(foo)"));
a(ClassTool::executePhpMethod("A->returnArgs(one, apple)"));
a(ClassTool::executePhpMethod("A->returnArgs([one, two], apple)"));
a(ClassTool::executePhpMethod("Ling\Bat\StringTool::camelCase2Constant('AtariPlayer')"));
a(ClassTool::executePhpMethod("A->returnArgs({orange: road, maurice: [1,2,3]}, 456)"));



```

Will output:

```html
string(5) "hello"

string(5) "hello"

array(1) {
  [0] => string(3) "foo"
}

array(2) {
  [0] => string(3) "one"
  [1] => string(5) "apple"
}

array(2) {
  [0] => array(2) {
    [0] => string(3) "one"
    [1] => string(3) "two"
  }
  [1] => string(5) "apple"
}

string(12) "ATARI_PLAYER"

array(2) {
  [0] => array(2) {
    ["orange"] => string(4) "road"
    ["maurice"] => array(3) {
      [0] => int(1)
      [1] => int(2)
      [2] => int(3)
    }
  }
  [1] => int(456)
}



```






getAbstractAncestors
-----------------
2019-02-13



```php
\ReflectionClass[]    getAbstractAncestors ( \ReflectionClass class )
```

Returns an array of all abstract ancestors classes (\ReflectionClass) for the given $class.

Example:

 
```php
$class = new \ReflectionClass("DocTools\Link\AnchorLink");
a(ClassTool::getAbstractAncestors($class));
```

Will output:

```html
array(1) {
  [0] => object(ReflectionClass)#3 (1) {
    ["name"] => string(18) "DocTools\Link\Link"
  }
}

```




getAncestors
-----------------
2019-04-04


```php
str    getAncestors ( \ReflectionClass class, bool:includeInterfaces = false )
```

Returns an array of \ReflectionClass representing the the ancestors of the given class.
It can also includes all interfaces (and parents) if the includeInterfaces argument is set to true.


### Example

```php
interface G{

}

interface F{

}

interface E extends F{

}

interface D{

}

abstract class C implements D, E{

}

class B extends C implements G{

}

class A extends B{

}


$class = new \ReflectionClass("A");
a(ClassTool::getAncestors($class, false)); // B C
a(ClassTool::getAncestors($class, true)); // B C D E F G
```





getClassSignature
-----------------
2019-02-08



```php
str    getClassSignature ( \ReflectionClass class )
```

Returns the class signature of the given $class.

Example of outputs:

- class Bat
- abstract class BaseNodeTreeBuilder implements NodeTreeBuilderInterface
- final class Imaginary implements Dream, Monday
- class ArrayRefResolverException extends \Exception implements \Throwable


Note: short class names are used only,
and if the class is not user defined (for instance the \Exception class),
the class name is prefixed with the backslash (\).

 
```php
$className = "ArrayRefResolver\Exception\ArrayRefResolverException";
$class = new \ReflectionClass($className);
az(ClassTool::getClassSignature( $class));
```

Will output:

```html
string(72) "class ArrayRefResolverException extends \Exception implements \Throwable"

```




getMethodContent
-----------
2016-12-22



```php
str    getMethodContent ( string:class, string:method )
```

Gets the code of the given method, from the start line
to the end line (including the signature).


```php
$content = ClassTool::getMethodContent(LayoutServices::class, 'displayLeftMenuBlocks');
a($content);
```


getMethodInnerContent
-----------
2016-12-22



```php
str    getMethodInnerContent ( string:class, string:method )
```

Gets the inner code of the given method.

 
```php
$content = ClassTool::getMethodInnerContent("\Some\MyClass",  'myMethod');
a($content);
``` 




getMethodNames
-----------
2018-03-06



```php
array    getMethodNames ( string:class, array:filter=[] )
```

Return the method names of the given class.
We can filter the method names using the following filters:

- static
- (one of)
    - public
    - protected
    - private

 
```php
$class = '\Core\Services\Hooks';
$methods = ClassTool::getMethodNames($class); // return all method names
$methods = ClassTool::getMethodNames($class, ['static', 'protected']); // return only static protected method names
``` 



getMethodSignature
-----------
2016-12-22



```php
str    getMethodSignature ( \ReflectionMethod:method )
```

Gets the signature of a given method.

 
```php
<?php


use Ling\Bat\ClassTool;
use Ling\DirScanner\DirScanner;

require_once "bigbang.php";


class A
{
    public static function pou(array &$daa, DirScanner $po, $pp = 6, \Closure $func)
    {
        return 6;
    }
}


$method = new \ReflectionMethod('A', 'pou');
a(ClassTool::getMethodSignature($method)); // public static function pou(array &$daa, \DirScanner\DirScanner $po, $pp, \Closure $func)
``` 


getShortName
-----------
2017-04-23



```php
str    getShortName ( object:object )
```

Return the short name for the given class.

For instance if the class is A\B\CCC,
it returns CCC.




hasMethod
----------
2020-07-09

```php
bool hasMethod ( str:className, str: methodName )
```

Returns whether the given class contains the given method.

Note: the class name must be in the reach of the current autoloader in order for this method to work correctly.





rewriteMethodContent
-----------
2016-12-25



```php
void    rewriteMethodContent ( string:class, string:method, callable:func )
```

Rewrites the file containing the given class and method, after updating its content.

The content can be modified using the third argument, a callable which accepts one argument: lines.

lines is an array which contains the lines inside the target method.

lines is passed as a reference to the transformer callback.

 
```php
<?php


use Ling\Bat\ClassTool;

require_once "bigbang.php";


class POOO
{


    public static function reindeer($someParams)
    {
        $doo = 6;
        return $doo;
    }

    public static function dormir(){
        return "pou";
    }

}


ClassTool::rewriteMethodContent('POOO', 'reindeer', function (&$lines) {
    array_splice($lines, 1, 0, '$doo += 9;');
});

```
 
 After executing this code, the file will look like this:



```php
<?php


use Ling\Bat\ClassTool;

require_once "bigbang.php";


class POOO
{


    public static function reindeer($someParams)
    {
        $doo = 6;
        $doo += 9;
        return $doo;
    }

    public static function dormir(){
        return "pou";
    }

}


ClassTool::rewriteMethodContent('POOO', 'reindeer', function (&$lines) {
    array_splice($lines, 1, 0, '$doo += 9;');
});

```
