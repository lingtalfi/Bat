<?php


namespace Ling\Bat\Util;


use Ling\Bat\Exception\BatException;
use Ling\ClassCooker\ClassCooker;
use Ling\TokenFun\TokenFinder\Tool\TokenFinderTool;

/**
 * The ExtendedReflectionClass class.
 *
 * https://stackoverflow.com/questions/30308137/get-use-statement-from-class
 *
 * Inspired by (https://gist.github.com/Zeronights/7b7d90fcf8d4daf9db0c)
 *
 *
 */
class ExtendedReflectionClass extends \ReflectionClass
{


    /**
     * Array of use statements for class.
     *
     * @var array
     */
    protected $useStatements;


    /**
     * Check if use statements have been parsed.
     *
     * @var boolean
     */
    protected $useStatementsParsed;


    /**
     * This property holds the theStartLine for this instance.
     * @var int=0
     */
    private $theStartLine;


    /**
     * Builds the ExtendedReflectionClass instance.
     * @param $argument
     * @throws \ReflectionException
     */
    public function __construct($argument)
    {
        parent::__construct($argument);
        $this->useStatements = [];
        $this->useStatementsParsed = false;
        $this->theStartLine = 0;

    }


    /**
     * Return array of use statements from class.
     *
     * The returned array is an array of items, each of which being an array with the following:
     *      - class: the real class used in the use statement
     *      - as: the alias version of the class used in the use statement, which defaults to the real class if no alias was used.
     *
     * @return array
     */
    public function getUseStatements()
    {
        return $this->parseUseStatements();
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Parse class file and get use statements from current namespace.
     * @return void
     */
    protected function parseUseStatements()
    {

        if ($this->useStatementsParsed) {
            return $this->useStatements;
        }

        if (!$this->isUserDefined()) {
            throw new BatException('Must parse use statements from user defined classes.');
        }


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
        $this->theStartLine = $cooker->getClassStartLine();


        $source = $this->readFileSource();
        $this->useStatements = $this->tokenizeSource($source);

        $this->useStatementsParsed = true;
        return $this->useStatements;
    }


    /**
     * Read file source up to the line where our class is defined.
     *
     * @return string
     */
    private function readFileSource()
    {
        $file = fopen($this->getFileName(), 'r');
        $line = 0;
        $source = '';

        while (!feof($file)) {
            ++$line;

            if ($line >= $this->theStartLine) {
                break;
            }

            $source .= fgets($file);
        }

        fclose($file);

        return $source;
    }


    /**
     * Parse the use statements from read source by
     * tokenizing and reading the tokens. Returns
     * an array of use statements and aliases.
     *
     * @param string $source
     * @return array
     */
    private function tokenizeSource(string $source)
    {

        $tokens = @token_get_all($source);


        $useStatements = TokenFinderTool::getUseDependencies($tokens, ['alias' => true]);
        $ret = [];

        foreach ($useStatements as $item) {
            list($class, $alias) = $item;
            if (null === $alias) {
                $alias = $class;
            }
            $ret[] = [
                "class" => $class,
                "alias" => $alias,
            ];
        }


        return $ret;
    }
}