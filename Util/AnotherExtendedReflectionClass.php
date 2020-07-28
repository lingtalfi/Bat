<?php


namespace Ling\Bat\Util;


use Ling\ClassCooker\ClassCooker;
use Ling\TokenFun\TokenFinder\NamespaceTokenFinder;
use Ling\TokenFun\TokenFinder\UseStatementsTokenFinder;

/**
 * The AnotherExtendedReflectionClass class.
 *
 */
class AnotherExtendedReflectionClass extends \ReflectionClass
{


    /**
     * Builds the AnotherExtendedReflectionClass instance.
     */
    public function __construct($argument)
    {
        parent::__construct($argument);
    }


    /**
     * Returns the number of the line containing the namespace declaration, or false if none was found.
     *
     *
     *
     * @return false|int
     */
    public function getNamespaceLineNumber()
    {
        $file = fopen($this->getFileName(), 'r');
        $lineNumber = 0;
        while (!feof($file)) {
            $lineNumber++;
            $line = fgets($file);
            $isNamespaceLine = $this->isNamespaceLine($line);
            if (true === $isNamespaceLine) {
                return $lineNumber;
            }
        }
        fclose($file);
        return false;
    }


    /**
     * Returns an array of items, each of which:
     *
     * - 0: use statement: string, the whole use statement line as written (for instance: use Ling\Bat\ClassTool as CTool;), also including comments if any
     * - 1: line number: int, the number of the line at which that use statement was found
     *
     *
     * This method assumes that each "use statement" is only defined on a single line, and that there is at most one use statement defined by line.
     *
     * @return array
     */
    public function getUseStatementsInfo(): array
    {
        $ret = [];

//        if (!$this->isUserDefined()) {
//            throw new BatException('Must parse use statements from user defined classes.');
//        }

        /**
         * Note: we don't rely on the getStartLine method of the reflection class, since
         * we assume that the observed file's content might be updated dynamically, and reflection class
         * doesn't handle dynamic changes.
         *
         * We only rely on token based methods.
         *
         */
        $cooker = new ClassCooker();
        $cooker->setFile($this->getFileName());
        $startLine = $cooker->getClassStartLine();




        $file = fopen($this->getFileName(), 'r');
        $lineNumber = 0;
        while (!feof($file)) {
            $lineNumber++;

            if ($lineNumber >= $startLine) {
                break;
            }

            $line = fgets($file);
            $isUseStatementLine = $this->isUseStatementLine($line);
            if (true === $isUseStatementLine) {
                $ret[] = [
                    $line,
                    $lineNumber,
                ];
            }
        }
        fclose($file);

        return $ret;
    }

    //--------------------------------------------
    //
    //--------------------------------------------

    /**
     * Parses the given line, and returns if it contains a valid "use statement".
     *
     * @param string $line
     * @return bool
     */
    private function isUseStatementLine(string $line): bool
    {
        $source = '<?php ' . PHP_EOL;
        $source .= $line;

        $tokens = @token_get_all($source);

        $o = new UseStatementsTokenFinder();
        $matches = $o->find($tokens);
        if ($matches) {
            return true;
        }
        return false;
    }


    /**
     * Parses the given line, and returns if it contains a valid namespace declaration.
     *
     * @param string $line
     * @return bool
     */
    private function isNamespaceLine(string $line): bool
    {
        $source = '<?php ' . PHP_EOL;
        $source .= $line;

        $tokens = token_get_all($source);
        $o = new NamespaceTokenFinder();
        $matches = $o->find($tokens);
        if ($matches) {
            return true;
        }
        return false;
    }
}