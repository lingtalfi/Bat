<?php


namespace Ling\Bat;

/**
 * The ShortCodeTool class.
 */
class ShortCodeTool
{


    /**
     * Parses a shortcode expression (which looks like the arguments in a php method call),
     * and return the corresponding array.
     *
     * This method is actually just a proxy to the original ShortCodeTool::parse method.
     * For more info about shortcode, please checkout the original documentation for the ShortCodeTool::parse method.
     *
     *
     * @param string $expr
     * @return array
     */
    public static function parse(string $expr): array
    {
        return \Ling\BeeFramework\Notation\String\ShortCode\Tool\ShortCodeTool::parse($expr);
    }
}