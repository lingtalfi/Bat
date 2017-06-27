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

}