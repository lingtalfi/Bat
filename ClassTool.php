<?php


namespace Bat;


class ClassTool
{

    /**
     * Example:
     *      $content = ClassTool::getMethodContent(LayoutBridge::class, 'displayLeftMenuBlocks');
     *
     *
     */
    public static function getMethodContent($class, $method)
    {
        // http://stackoverflow.com/questions/7026690/reconstruct-get-code-of-php-function
        $func = new \ReflectionMethod($class, $method);
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

    public static function getMethodSignature(\ReflectionMethod $method)
    {
        $s = '';

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

            if ($parameter->isArray()) {
                $s .= 'array ';
            } else {
                $hint = $parameter->getClass();
                if (null !== $hint) {
                    $s .= '\\' . $hint->name . ' ';
                }
            }

            if (true === $parameter->isPassedByReference()) {
                $s .= '&';
            }
            $s .= '$' . $parameter->getName();

            if ($parameter->isOptional()) {
                a($parameter);
                $s .= ' = ' . $parameter->getDefaultValue();
            }

        }
        $s .= ')';
        return $s;
    }
}