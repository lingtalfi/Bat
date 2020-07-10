<?php


namespace Ling\Bat\Util;


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

        $file = fopen($this->getFileName(), 'r');
        $lineNumber = 0;
        while (!feof($file)) {
            $lineNumber++;

            if ($lineNumber >= $this->getStartLine()) {
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

        $tokens = token_get_all($source);
        $o = new UseStatementsTokenFinder();
        $matches = $o->find($tokens);
        if ($matches) {
            return true;
        }
        return false;
    }
}