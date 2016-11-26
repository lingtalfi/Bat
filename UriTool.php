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


    public static function getWebsiteAbsoluteUrl()
    {
        // http://stackoverflow.com/questions/1175096/how-to-find-out-if-youre-using-https-without-serverhttps
        $isSecure = false;
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $isSecure = true;
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
            $isSecure = true;
        }

        $proto = (true === $isSecure) ? 'https' : 'http';
        if (array_key_exists('HTTP_HOST', $_SERVER)) {
            $domain = $_SERVER['HTTP_HOST'];
        } elseif (array_key_exists('SERVER_NAME', $_SERVER)) {
            $domain = $_SERVER['SERVER_NAME'];
        } else {
            return false;
        }
        return $proto . '://' . $domain;
    }


}
