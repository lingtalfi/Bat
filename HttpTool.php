<?php

namespace Bat;


class HttpTool
{

    /**
     *
     * Post the given data to the given uri, and return the result.
     *
     *
     *
     * @param $uri
     * @param array $data
     * @return string|false
     */
    public static function post($uri, array $data = [])
    {
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        return file_get_contents($uri, false, $context);
    }


    /**
     * https://stackoverflow.com/questions/1175096/how-to-find-out-if-youre-using-https-without-serverhttps
     */
    public static function isHttps()
    {
        if (array_key_exists("HTTPS", $_SERVER) && 'on' === $_SERVER["HTTPS"]) {
            return true;
        }
        if (array_key_exists("SERVER_PORT", $_SERVER) && 443 === (int)$_SERVER["SERVER_PORT"]) {
            return true;
        }
        if (array_key_exists("HTTP_X_FORWARDED_SSL", $_SERVER) && 'on' === $_SERVER["HTTP_X_FORWARDED_SSL"]) {
            return true;
        }
        if (array_key_exists("HTTP_X_FORWARDED_PROTO", $_SERVER) && 'https' === $_SERVER["HTTP_X_FORWARDED_PROTO"]) {
            return true;
        }
        return false;
    }

}