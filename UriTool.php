<?php

namespace Ling\Bat;

/**
 * The UriTool class.
 * LingTalfi 2015-12-04
 */
class UriTool
{
    /**
     * Appends parameters to a base uri, and in the form of a query string (starting with a question mark).
     *
     */
    public static function appendParams($baseUri, array $parameters = [])
    {
        $ret = $baseUri;
        if (false === strpos($baseUri, "?")) {
            $sep = '?';
        } else {
            $sep = '&';
        }

        if ($parameters) {
            $ret .= $sep;
            $ret .= self::httpBuildQuery($parameters);
        }
        return $ret;
    }


    /**
     * Returns string|false
     *
     */
    public static function fileGetContents($url)
    {
        if (true === (bool)ini_get('allow_url_fopen')) {
            return file_get_contents($url);
        } elseif (function_exists('curl_version')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        return false;
    }

    /**
     * Returns the current host based on the $_SERVER information,
     * or false if it doesn't find anything (i.e. cli environment for instance).
     *
     * @return false|string
     */
    public static function getHost()
    {
        if (array_key_exists('HTTP_HOST', $_SERVER)) {
            $domain = $_SERVER['HTTP_HOST'];
        } elseif (array_key_exists('SERVER_NAME', $_SERVER)) {
            $domain = $_SERVER['SERVER_NAME'];
        } else {
            $domain = false;
        }
        return $domain;
    }


    /**
     * Returns the get parameters attached to the given url.
     *
     * @param string $url
     * @return array
     */
    public static function getParams(string $url): array
    {
        $result = [];
        $p = explode('?', $url, 2);
        if (2 === count($p)) {
            $q = array_pop($p);
            parse_str($q, $result);
            return $result;
        }
    }


    /**
     * Returns the absolute url of the current process if available, or false otherwise.
     *
     *
     * @return false|string
     */
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


    /**
     * Returns the http query based on the given parameters.
     * It's almost like the http_build_query php function, except that it returns a non-url-encoded string.
     *
     * @param array $parameters
     * @return string
     */
    public static function httpBuildQuery(array $parameters): string
    {
        return urldecode(http_build_query($parameters));
    }

    /**
     * Adds a parameter to the given get array, which usually would be the $_GET array.
     * The added parameter is chosen randomly by default, or it can be fixed if the key argument is defined.
     *
     *
     * This might be useful in some cases for instance when you want to redirect the user to a success page
     * after a form, and you want the redirect page to be the form page itself.
     * In this case, without randomizing the url, if the user refresh the page the $_POST payload will be
     * resent (tested in firefox in 2019-12-09). By randomizing the url parameters, the browser will
     * consider the page as a new one, and the payload will be dropped.
     *
     *
     *
     * @param array $get
     * @param string $key
     */
    public static function randomize(array &$get, string $key = null)
    {
        $rand = rand(0, 9999);
        if (null !== $key) {
            $get[$key] = $rand;
            return;
        }


        $originalKey = 'r';
        $key = $originalKey;
        $c = 0;
        while (true === array_key_exists($key, $get)) {
            $key = $originalKey . $c++;
        }
        $get[$key] = $rand;

    }


    /**
     * Returns an uri from the given parameters.
     *
     *
     * @param null $uri
     * @param array $params
     * @param bool $replace
     * @param bool $absolute
     * @return string
     */
    public static function uri($uri = null, array $params = [], $replace = true, $absolute = false)
    {
        // assuming we are not using a cli environment
        if (null === $uri) {
            $uri = $_SERVER['REQUEST_URI'];
            $p = explode("?", $uri, 2);
            $uri = $p[0];
        }
        if (false === $replace) {
            $params = array_merge($_GET, $params);
        }
        $prefix = "";
        if (true === $absolute) {
            $prefix = UriTool::getWebsiteAbsoluteUrl();
        }
        $ret = $prefix . UriTool::appendParams($uri, $params);
        return rtrim($ret, '?');
    }
}