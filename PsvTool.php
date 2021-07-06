<?php


namespace Ling\Bat;

use Ling\Bat\Exception\BatException;

/**
 * The PsvTool class.
 *
 *
 * The word "psv" stands for protected separated values.
 * Where protected is a string properly wrapped with quotes (either single quotes or double quotes).
 *
 * The escape char is the backslash char (\).
 * The escape char can only escape quotes (i.e., not the comma).
 *
 *
 *
 *
 */
class PsvTool
{


    /**
     * Joins array elements in protected components separated by the given delim.
     * The protection depends on the quote type:
     *
     * - s: single quote
     * - d: double quote
     *
     *
     *
     * @param string $delim
     * @param array $values
     * @param string $quoteType
     * @return string
     */
    public static function implode(string $delim, array $values, $quoteType = "s"): string
    {
        if (false === in_array($quoteType, ['d', 's'])) {
            throw new BatException("Invalid quoteType: $quoteType.");
        }
        $s = "";
        $q = "s" === $quoteType ? "'" : '"';

        $c = 0;
        foreach ($values as $v) {
            if (0 !== $c) {
                $s .= $delim;
            }


            if ('s' === $quoteType) {
                $v = str_replace("'", "\'", $v);
            } else {
                $v = str_replace('"', '\"', $v);
            }
            $s .= $q . $v . $q;
            $c++;
        }

        return $s;
    }


    /**
     *
     * Returns an array containing the different values of the given psv.
     *
     * This works similarly to the php explode function.
     *
     * utf-8 encoding is assumed (I guess, see the source code for more hints).
     *
     * Any malformed value (i.e., not wrapped with quotes) will result in an empty string.
     *
     * For instance, the following:
     *
     * - "ok", , nope, , "ok",
     *
     * will result in the following array:
     *
     * - "ok", "", "", "", "ok", ""
     *
     *
     *
     *
     *
     *
     * @param string $psv
     * @param int $limit
     * @return array
     */
    public static function explodeProtected(string $psv, int $limit = 0): array
    {
        $ret = [];

        $chars = mb_str_split($psv);
        $previousValue = "";
        $previousChar = "";
        $startingQuote = null;
        $valueCaptured = false;
        foreach ($chars as $c) {
            if (null === $startingQuote) {
                // capture of quote has not started yet
                if (',' === $c) {
                    if (false === $valueCaptured) {
                        $ret[] = $previousValue;
                    }
                    $previousValue = "";
                    $startingQuote = null;
                    $valueCaptured = false;
                } elseif ("'" === $c) {
                    $startingQuote = "'";
                } elseif ('"' === $c) {
                    $startingQuote = '"';
                }
            } else {
                // capture of quote has started

                $valueCaptured = false;


                if ($startingQuote === $c) {
                    if ("\\" !== $previousChar) { // ending quote
                        $ret[] = $previousValue;
                        $previousValue = "";
                        $startingQuote = null;
                        $valueCaptured = true;
                    } else {
                        // the previous char was an escape char, we remove it to keep the intent of the string writer
                        $previousValue = mb_substr($previousValue, 0, -1);
                        $previousValue .= $c;

                    }
                } else {
                    $previousValue .= $c;
                }
            }
            $previousChar = $c;
        }


        /**
         * At the end of the loop, if the string started with a quote but there is no end quote,
         * this is a malformed string. In this case, like for all malformed strings, we set the
         * value to an empty string
         *
         */
        if ('' !== $previousValue) {
            $ret[] = "";
        }

        if (',' === mb_substr(trim($psv), -1)) { // when last char is comma...
            $ret[] = "";
        }

        if ($limit > 0) { // i know, that's bad, but who cares...

            $count = count($ret);
            while ($count > $limit) {
                array_pop($ret);
                $count = count($ret);
            }
        }


        return $ret;
    }


}