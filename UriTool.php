<?php

namespace Bat;

/*
 * LingTalfi 2015-12-04
 */
class UriTool
{

    /**
     * Appends parameters to a base uri, and in the form of a query string (starting with a question mark). 
     */
    public static function appendQueryString($baseUri, array $parameters = [])
    {
        $ret = $baseUri;
        $sep = '?';
        if ($parameters) {
            $ret .= $sep;
            $i = 0;
            foreach ($parameters as $k => $v) {
                if (0 !== $i) {
                    $ret .= "&";
                }
                $ret .= "$k=$v";
                $i++;
            }
        }
        return $ret;
    }
}
