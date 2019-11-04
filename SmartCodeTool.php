<?php

namespace Ling\Bat;


use Ling\BabyYaml\BabyYamlUtil;
use Ling\BabyYaml\Reader\Exception\ParseErrorException;
use Ling\Bat\Exception\BatException;

/**
 * The SmartCodeTool class.
 * Note: I found ShortCodeTool buggy and not flexible enough, hence this class (which is some kind
 * of update on shortcode tool).
 *
 *
 * More about smart code: https://github.com/lingtalfi/NotationFan/blob/master/smart-code.md
 *
 *
 *
 *
 * Smart code is an alias for [BabyYaml](https://github.com/lingtalfi/BabyYaml) inline syntax.
 *
 */
class SmartCodeTool
{


    /**
     * Parses the given $expr and returns the corresponding result.
     *
     * Under the hood, the babyYaml inline parser is used.
     * Please refer to the BabyYaml documentation for more details.
     *
     *
     * @param string $expr
     * @return mixed
     * @throws ParseErrorException
     * An exception is thrown when a syntax error occurs.
     */
    public static function parse(string $expr)
    {
        $var = BabyYamlUtil::readBabyYamlString('root: ' . $expr);
        return $var['root'];
    }


    /**
     * Parses the given $expr as if it was the arguments of a function, and returns the resulting array.
     *
     * So for instance, the string:
     *
     * - a, b, c
     *
     * Would return the array:
     *
     * - 0: a
     * - 1: b
     * - 2: c
     *
     *
     * @param string $expr
     * @return array
     * @throws ParseErrorException
     */
    public static function parseArguments(string $expr): array
    {
        return self::parse('[' . $expr . ']');
    }


    /**
     * Replaces the smartCodeFunctions calls found in the given array with their replacement.
     *
     * A smartCodeFunction call has the following notation:
     *
     * - $functionName ( $smartCodeArguments )
     *
     * With:
     *
     * - $functionName, the given function name
     * - $smartCodeArguments, a string representing the smart code arguments.
     *
     *
     * The given replaceFunc will be called whenever the smartCodeFunction is detected.
     * It will be executed with the smart code arguments as parameters.
     * Its value will be the replacement value used.
     *
     * Note: if the smartCodeFunction notation is part of a bigger string, then the replacement value
     * must be stringable (i.e. not an array), otherwise an exception will be thrown.
     *
     *
     * Note: spaces around the parenthesis wrapping the $smartCodeArguments don't matter.
     *
     * Note: functionName should contain only alpha-numerical characters, or underscore (like a php function name),
     * otherwise results are unpredictable.
     *
     *
     * The options array contains the following properties:
     *
     * - openingParenthesisSymbol: (
     * - closingParenthesisSymbol: )
     *
     * Note: generally, we need to use the openingParenthesisSymbol and closingParenthesisSymbol options only when
     * if we know in advance that the arguments of our smartCodeFunction might contain regular parenthesis (which is often not the case).
     *
     *
     *
     * @param array $arr
     * @param string $functionName
     * @param callable $replaceFunc
     * @param array $options
     */
    public static function replaceSmartCodeFunction(array &$arr, string $functionName, callable $replaceFunc, array $options = [])
    {
        $openingParenthesis = $options['openingParenthesisSymbol'] ?? '(';
        $closingParenthesis = $options['closingParenthesisSymbol'] ?? ')';


        $openingParenthesisEsc = preg_quote($openingParenthesis, '!');
        $closingParenthesisEsc = preg_quote($closingParenthesis, '!');

        $pattern = '!' . $functionName . '\s*' . $openingParenthesisEsc . '\s*([^' . $closingParenthesisEsc . ']+)\s*' . $closingParenthesisEsc . '!';

        array_walk_recursive($arr, function (&$v) use ($pattern, $replaceFunc) {
            if (preg_match($pattern, $v, $matches)) {

                $sArgs = trim($matches[1]);
                $args = self::parseArguments($sArgs);
                $replacement = call_user_func_array($replaceFunc, $args);

                $isStandAloneValue = (strlen(trim($v)) === strlen($matches[0]));
                if (true === $isStandAloneValue) {
                    $v = $replacement;
                } else {
                    if (false === StringTool::isStringable($replacement)) {
                        $type = gettype($replacement);
                        throw new BatException("The replacement value matching $v must be stringable, $type given.");
                    }
                    $v = (string)$replacement;
                }
            }
        });
    }

}