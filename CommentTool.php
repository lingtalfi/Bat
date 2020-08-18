<?php


namespace Ling\Bat;


use Ling\Bat\Exception\BatException;

/**
 * The CommentTool class.
 */
class CommentTool
{


    /**
     * Comments the given string and returns the result.
     *
     * We can choose the type of comments being used with the type argument, which can be one of:
     *
     * - single: starting with //
     * - doc:    starting with /**
     *
     *
     * @param string $string
     * @param string $type
     * @return string
     * @throws \Exception
     */
    public static function comment(string $string, string $type = 'single'): string
    {
        switch ($type) {
            case "doc":
                $lines = explode(PHP_EOL, $string);
                $string = "/** " . implode(PHP_EOL . "* ", $lines) . PHP_EOL . "*/";
                break;
            case "single":
                $lines = explode(PHP_EOL, $string);
                $string = "// " . implode(PHP_EOL . "// ", $lines);
                break;
            default:
                throw new BatException("Unknown comment type: $type.");
        }
        return $string;
    }

}