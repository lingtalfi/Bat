<?php


namespace Ling\Bat;


use Ling\Bat\Exception\BatException;

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