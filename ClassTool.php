<?php


namespace Ling\Bat;


use Ling\Bat\Exception\BatException;
use Ling\Bat\Util\AnotherExtendedReflectionClass;
use Ling\Bat\Util\ExtendedReflectionClass;
use Ling\TokenFun\TokenFinder\Tool\TokenFinderTool;

/**
 * The ClassTool class.
 */
class ClassTool
{

    /**
     * Executes a php method and return the result.
     * For convenience, developers can refer to this method call as a "smart php method call".
     *
     *
     * The given $phpMethod must have one of the following format (or else an exception will be thrown):
     *
     * - $class::$method
     * - $class::$method ( $args )
     * - $class->$method
     * - $class->$method ( $args )
     *
     *
     * Note that the first two forms refer to a static method call, while the last two forms refer to a method call on
     * an instance (instantiation is done by this method).
     *
     *
     * With:
     *
     * - $class: the full class name (example: Ling\Bat)
     * - $method: the name of the method to execute
     * - $args: a list of arguments written with smartCode notation (see SmartCodeTool class for more details).
     *              Note: we can use regular php notation as it's a subset of the smartCode notation.
     *
     * See the [examples here](https://github.com/lingtalfi/Bat/blob/master/ClassTool.md#executephpmethod-aka-smart-php-method-call)
     *
     *
     *
     *
     * @param string $phpMethod
     * @return mixed
     * @throws \Exception
     */
    public static function executePhpMethod(string $phpMethod)
    {

        if (preg_match('!
        (?<class>[a-zA-Z0-9_\\\\]*)
        (?<sep>::|->)
        (?<method>[a-zA-Z0-9_]*)
        (?<args>\(.*\))?
        !x', $phpMethod, $match)) {


            $class = $match['class'];
            $sep = $match['sep'];
            $method = $match['method'];
            $args = [];
            if (array_key_exists('args', $match)) {
                $args = SmartCodeTool::parse("[" . substr($match['args'], 1, -1) . ']');
            }

            $ret = null;
            if ('::' === $sep) {
//                $ret = $class::$method($args);
                $ret = call_user_func_array([$class, $method], $args);
            } else {
                $instance = new $class;
                $ret = call_user_func_array([$instance, $method], $args);
            }
            return $ret;
        }
        throw new BatException("Invalid php method syntax: $phpMethod.");
    }


    /**
     * Returns an array of all abstract ancestors classes (\ReflectionClass) for the given $class.
     *
     *
     * @param \ReflectionClass $class
     * @return \ReflectionClass[]
     */
    public static function getAbstractAncestors(\ReflectionClass $class): array
    {
        $ret = [];
        self::collectAbstractAncestors($class, $ret);
        return $ret;
    }


    private static function collectAbstractAncestors(\ReflectionClass $class, array &$collection)
    {
        $parent = $class->getParentClass();
        if ($parent instanceof \ReflectionClass) {
            if ($parent->isAbstract()) {
                $collection[] = $parent;
            }
            self::collectAbstractAncestors($parent, $collection);
        }
    }


    /**
     * Returns an array of \ReflectionClass representing the the ancestors of the given class.
     * It can also includes all interfaces (and parents) if the includeInterfaces argument is set to true.
     *
     *
     *
     * @param \ReflectionClass $class
     * @param bool $includeInterfaces
     * @return array
     */
    public static function getAncestors(\ReflectionClass $class, bool $includeInterfaces = false)
    {
        $ret = [];
        while (false !== ($parent = $class->getParentClass())) {
            $ret[] = $parent;
            if (true === $includeInterfaces) {
                foreach ($class->getInterfaces() as $interface) {
                    $ret[] = $interface;
                    while (false !== ($interfaceParent = $interface->getParentClass())) {
                        $ret[] = $interfaceParent;
                        $interface = $interfaceParent;
                    }
                }
            }
            $class = $parent;
        }

        if (true === $includeInterfaces) {
            $interfaces = $class->getInterfaces();
            foreach ($interfaces as $interface) {
                $ret[] = $interface;
                $ret = array_merge($ret, self::getAncestors($interface));
            }
        }

        $ret = array_unique($ret);
        return $ret;
    }


    /**
     *
     * Returns the class name of the first class found in the given file.
     *
     * If the file doesn't exist or doesn't contain an autoloader reachable class, an exception is thrown.
     *
     *
     * @param string $file
     * @return string
     * @throws \Exception
     */
    public static function getClassNameByFile(string $file): string
    {
        if (file_exists($file)) {

            $tokens = token_get_all(file_get_contents($file));
            $items = TokenFinderTool::getClassNames($tokens, true, [
                "includeInterfaces" => false,
            ]);
            if ($items) {
                $className = array_shift($items);
                return $className;
            }
            throw new BatException("No class found in file: $file.");

        }
        throw new BatException("Class file doesn't exist: $file.");
    }


    /**
     * This is a proxy to the [TokenFinderTool](https://github.com/lingtalfi/TokenFun/blob/master/TokenFinder/Tool/TokenFinderTool.php) method with the same name.
     *
     *
     * @return array
     */
    public static function getClassPropertyBasicInfo(string $className): array
    {
        return TokenFinderTool::getClassPropertyBasicInfo($className);
    }


    /**
     * Returns the class signature of the given $class.
     *
     * Example:
     *
     * - class Bat
     * - abstract class BaseNodeTreeBuilder implements NodeTreeBuilderInterface
     * - final class Imaginary implements Dream, Monday
     * - class ArrayRefResolverException extends \Exception implements \Throwable
     *
     *
     * Note: short class names are used only,
     * and if the class is not user defined (for instance the \Exception class),
     * the class name is prefixed with the backslash (\).
     *
     *
     *
     *
     *
     *
     * @param \ReflectionClass $class
     * @return string
     */
    public static function getClassSignature(\ReflectionClass $class)
    {
        $s = '';

        if (true === $class->isFinal()) {
            $s .= 'final ';
        }

        if (true === $class->isAbstract()) {
            $s .= 'abstract ';
        }

        $s .= 'class ';
        $className = $class->getShortName();
        if (false === $class->isUserDefined()) {
            $className = '\\' . $className;
        }
        $s .= $className . ' ';


        $parent = $class->getParentClass();
        if (false !== $parent) {
            $className = $parent->getShortName();
            if (false === $parent->isUserDefined()) {
                $className = '\\' . $className;
            }
            $s .= 'extends ' . $className . ' ';
        }

        $interfaces = $class->getInterfaces();
        if ($interfaces) {

            $s .= 'implements ';
            $c = 0;
            foreach ($interfaces as $interface) {
                if (0 !== $c++) {
                    $s .= ', ';
                }
                $className = $interface->getShortName();
                if (false === $interface->isUserDefined()) {
                    $className = '\\' . $className;
                }
                $s .= $className;
            }
        }
        return $s;
    }


    /**
     * Returns the number of the line where the first class is declared in the given file.
     *
     * Note: the class must be reachable by the current autoloader(s), otherwise an exception will be thrown.
     *
     * @param string $file
     * @return int
     */
    public static function getClassStartLineByFile(string $file): int
    {
        $className = self::getClassNameByFile($file);
        $o = new \ReflectionClass($className);
        return $o->getStartLine();
    }


    /**
     * Returns the absolute path of the file containing the given class.
     *
     * Note: the class must be reachable by the current autoloader(s), otherwise an exception will be thrown.
     *
     * @param string $className
     * @return string
     * @throws \Exception
     */
    public static function getFile(string $className): string
    {
        $o = new \ReflectionClass($className);
        return $o->getFileName();
    }


    /**
     * Example:
     *      $content = ClassTool::getMethodContent(LayoutServices::class, 'displayLeftMenuBlocks');
     *
     * @return string|false
     *
     */
    public static function getMethodContent($class, $method)
    {
        // http://stackoverflow.com/questions/7026690/reconstruct-get-code-of-php-function
        try {
            $func = new \ReflectionMethod($class, $method);
        } catch (\ReflectionException $e) {
            return false;
        }
        $filename = $func->getFileName();
        $start_line = $func->getStartLine() - 1; // it's actually - 1, otherwise you wont get the function() block
        $end_line = $func->getEndLine();
        $length = $end_line - $start_line;
        $source = file($filename);
        $body = implode("", array_slice($source, $start_line, $length));
        $body = trim($body);
//        if (true === $contentOnly) {
//            if (preg_match('!{(.*)}!s', $body, $match)) {
//                $body = trim($match[1]);
//            }
//        }
        return $body;
    }


    public static function getMethodInnerContent($class, $method)
    {
        if (false === ($content = self::getMethodContent($class, $method))) {
            return false;
        }
        $content = substr($content, 0, -1); // remove trailing }
        $p = explode('{', $content, 2);
        return $p[1];
    }

    public static function getMethodSignature(\ReflectionMethod $method)
    {
        $s = '';
        if (true === $method->isFinal()) {
            $s .= 'final ';
        }
        if (true === $method->isAbstract()) {
            $s .= 'abstract ';
        }
        if (true === $method->isPublic()) {
            $s .= 'public ';
        }
        if (true === $method->isProtected()) {
            $s .= 'protected ';
        }
        if (true === $method->isPrivate()) {
            $s .= 'private ';
        }
        if (true === $method->isStatic()) {
            $s .= 'static ';
        }
        $s .= 'function ';

        $s .= $method->getName();
        $s .= '(';
        $i = 0;
        foreach ($method->getParameters() as $parameter) {
            if ($i++ > 0) {
                $s .= ', ';
            }


            if ($parameter->hasType()) {
                if ($parameter->allowsNull() && false === $parameter->isOptional()) {
                    $s .= '?';
                }
                $s .= (string)$parameter->getType() . ' ';
            }

            if (true === $parameter->isPassedByReference()) {
                $s .= '&';
            }

            if (true === $parameter->isVariadic()) {
                $s .= '...';
            }

            $s .= '$' . $parameter->getName();


            if (
                true === $parameter->isOptional() &&
                false === $parameter->isVariadic() // assuming a variadic is never optional
            ) {
                $defaultValue = $parameter->getDefaultValue();
                if (is_array($defaultValue)) {
                    $defaultValue = DebugTool::toString($defaultValue);
                }
                $s .= ' = ' . $defaultValue;
            }

        }
        $s .= ')';
        return $s;
    }


    /**
     * @param $class
     * @param array $filter , available filters are:
     *          - static
     *          - (one of)
     *              - public
     *              - protected
     *              - private
     *
     * @return array
     */
    public static function getMethodNames($class, array $filter = [])
    {
        $ret = [];
        $r = new \ReflectionClass($class);
        $methods = $r->getMethods();
        $isStatic = in_array('static', $filter, true);
        $visibility = null;
        $visibilityMap = [
            'public' => \ReflectionMethod::IS_PUBLIC,
            'protected' => \ReflectionMethod::IS_PROTECTED,
            'private' => \ReflectionMethod::IS_PRIVATE,
        ];

        if (in_array('public', $filter, true)) {
            $visibility = $visibilityMap["public"];
        } elseif (in_array('protected', $filter, true)) {
            $visibility = $visibilityMap["protected"];
        } elseif (in_array('private', $filter, true)) {
            $visibility = $visibilityMap["private"];
        }


        foreach ($methods as $method) {


            // checking visibility
            if ($visibility) {
                if (
                    (\ReflectionMethod::IS_PUBLIC === $visibility && false === $method->isPublic()) ||
                    (\ReflectionMethod::IS_PROTECTED === $visibility && false === $method->isProtected()) ||
                    (\ReflectionMethod::IS_PRIVATE === $visibility && false === $method->isPrivate())
                ) {
                    continue;
                }
            }

            // checking static (which defaults to false)
            if ($isStatic && false === $method->isStatic()) {
                continue;
            }
            $ret[] = $method->name;

        }
        return $ret;
    }


    /**
     * Returns the number of the line containing the first namespace declaration found,
     * or false if no namespace declaration was found.
     *
     * @param string $file
     * @return int|false
     */
    public static function getNamespaceLineNumberByFile(string $file)
    {
        $className = self::getClassNameByFile($file);
        $o = new AnotherExtendedReflectionClass($className);
        return $o->getNamespaceLineNumber();
    }


    /**
     * Returns an info array of the given property, or false if the property doesn't exist.
     *
     *
     * The returned array looks like this:
     * - 0: line number of the property declaration
     * - 1: end line number of the comment
     * - 2: the comment text
     *
     *
     * Note: the given class name must be reachable by the current autoloader(s).
     *
     *
     *
     *
     *
     * @param string $className
     * @param string $propertyName
     * @return array|false
     * @throws \Exception
     */
    public static function getPropertyInfo(string $className, string $propertyName)
    {
        $o = new \ReflectionClass($className);
        if (true === $o->hasProperty($propertyName)) {
            $p = $o->getProperty($propertyName);


            $docComment = $p->getDocComment();
            if (false !== $docComment) {
                return $docComment;
            }
        }
        return false;
    }


    /**
     * Returns the reflection class instance corresponding to the given className.
     *
     * False is returned if the reflection class can't be instantiated.
     *
     * @param string $className
     * @return false|\ReflectionClass
     */
    public static function getReflectionClass(string $className): \ReflectionClass|false
    {
        try {
            return new \ReflectionClass($className);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return string, the short name for the given class.
     * For instance if the class is A\B\CCC,
     * it returns CCC.
     *
     */
    public static function getShortName($object)
    {
        $p = explode('\\', get_class($object));
        return array_pop($p);
    }


    /**
     * Extracts the class from the given useStatement and returns it.
     *
     *
     * @param string $useStatement
     * @return string
     */
    public static function getUseStatementClassByUseStatement(string $useStatement): string
    {
        $useStatement = trim($useStatement);
        $useStatement = substr($useStatement, 3); // get rid of the use prefix
        $useStatement = trim($useStatement, ' ;');
        $p = preg_split('!\s+as\s+!', $useStatement, 2);
        return array_shift($p);
    }


    /**
     * Returns the class names found in the use statements for the given class.
     *
     * If the useAliasNames flag is set to true, it will return aliases (when defined) instead of the class names.
     *
     *
     * @param string $className
     * @param bool $useAliasNames
     * @return array
     * @throws \Exception
     */
    public static function getUseStatements(string $className, bool $useAliasNames = false): array
    {

        $ret = [];
        $o = new ExtendedReflectionClass($className);
        $statements = $o->getUseStatements();
        foreach ($statements as $statement) {
            if (false === $useAliasNames) {
                $ret[] = $statement['class'];
            } else {
                $ret[] = $statement['as'];
            }
        }
        return $ret;
    }

    /**
     * Returns an array of items, each of which:
     *
     * - 0: use statement: string, the whole use statement line as written (for instance: use Ling\Bat\ClassTool as CTool;), also including // comments if any,
     *      and including the last "PHP_EOL" char
     * - 1: line number: int, the number of the line at which that use statement was found
     *
     *
     * This method assumes that each "use statement" is only defined on a single line, and that there is at most one use statement defined by line.
     *
     *
     * Note: the statements are ordered by ascending line number.
     *
     *
     * @param string $file
     * @return array
     * @throws \Exception
     */
    public static function getUseStatementsInfoByFile(string $file): array
    {
        $className = self::getClassNameByFile($file);
        $o = new AnotherExtendedReflectionClass($className);
        return $o->getUseStatementsInfo();
    }

    /**
     * Returns whether the given class contains the given method.
     *
     * Note: the class name must be in the reach of the current autoloader in order
     * for this method to work correctly.
     *
     * @param string $className
     * @param string $method
     * @return bool
     */
    public static function hasMethod(string $className, string $method): bool
    {
        $methods = self::getMethodNames($className);
        return in_array($method, $methods, true);
    }


    /**
     * Returns whether the class, contained in the given file, contains the given method.
     *
     * Note: the class name must be in the reach of the current autoloader in order
     * for this method to work correctly.
     * It is also assumed that the given class file exists, and that it contains only one class.
     *
     *
     *
     * @param string $classFile
     * @param string $method
     * @return bool
     * @throws \Exception
     */
    public static function hasMethodByFile(string $classFile, string $method): bool
    {
        $className = self::getClassNameByFile($classFile);
        $c = new \ReflectionClass($className);
        return $c->hasMethod($method);
    }


    /**
     * Returns whether the given class contains the given property.
     * Note: the given class must be reachable by the current autoloader(s).
     *
     *
     * @param string $className
     * @param string $propertyName
     * @return bool
     */
    public static function hasProperty(string $className, string $propertyName): bool
    {
        $o = new \ReflectionClass($className);
        return $o->hasProperty($propertyName);
    }


    /**
     * Returns whether the given class is referenced from an use statement in the given file.
     *
     * Note: this method ignore use statement aliases and always use the "real" class.
     *
     *
     *
     *
     *
     * @param string $file
     * @param string $useStatementClass
     * @return bool
     */
    public static function hasUseStatementByFile(string $file, string $useStatementClass): bool
    {
        $className = self::getClassNameByFile($file);
        $useStatements = self::getUseStatements($className);
        azf($className, $useStatements);
        return in_array($useStatementClass, $useStatements, true);
    }


    /**
     * Returns whether the given class is loaded (i.e. accessible via auto-loaders).
     *
     * @param string $className
     * @return bool
     */
    public static function isLoaded(string $className): bool
    {
        return class_exists($className, true);
    }


    /**
     * Instantiates the given class with the given args, and returns its instance.
     *
     * If the class cannot be instantiated, the behaviour of this method depends on the throwEx flag:
     *
     * - if true, throws an exception
     * - if false, returns false
     *
     *
     *
     * @param string $className
     */
    public static function instantiate(string $className, array $args = null, bool $throwEx = false)
    {
        if (true === self::isLoaded($className)) {
            if (null === $args) {
                $o = new $className();
            } else {
                $o = new $className($args);
            }
            return $o;
        } elseif (true === $throwEx) {
            throw new BatException("Cannot instantiate class $className.");
        }
        return false;
    }


    /**
     * @throws \ReflectionException when the class/method doesn't exist
     */
    public static function rewriteMethodContent($class, $method, $func)
    {
        $_method = new \ReflectionMethod($class, $method); // check that method exist
        $file = $_method->getFileName();
        $fileContent = file_get_contents($file);
        $content = preg_replace_callback('!function\s+\b' . $method . '\b(.*){(.*)}!Ums', function ($match) use ($func, $method) {
            $body = trim($match[2]);
            $p = explode(PHP_EOL, $body);
            $lines = array_filter(array_map('trim', $p));
            call_user_func_array($func, [&$lines]);
            $s8 = str_repeat(' ', 8);
            $s = '';
            $s .= 'function ' . $method . $match[1] . '{' . PHP_EOL . $s8 . implode(PHP_EOL . $s8, $lines) . PHP_EOL . '    }';
            return $s;
        }, $fileContent);
        file_put_contents($file, $content);

    }
}