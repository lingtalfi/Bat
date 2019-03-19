<?php


namespace Ling\Bat;


/**
 * The ObTool class.
 */
class ObTool
{

    public static function cleanAll($returnContent = false)
    {
        if (false === $returnContent) {
            while (ob_get_level()) {
                ob_get_clean();
            }
        } else {
            $s = "";
            while (ob_get_level()) {
                $s .= ob_get_clean();
            }
            return $s;
        }
    }



    public static function writeWithoutBuffering(callable $printCallable){
        // https://www.binarytides.com/php-output-content-browser-realtime-buffering/
        // Turn off output buffering
        ini_set('output_buffering', 'off');
        // Turn off PHP output compression
        ini_set('zlib.output_compression', false);


        //Flush (send) the output buffer and turn off output buffering
        //ob_end_flush();
        while (@ob_end_flush()) ;


        // Implicitly flush the buffer(s)
        ini_set('implicit_flush', true);
        ob_implicit_flush(true);


        //prevent apache from buffering it for deflate/gzip
//        header("Content-type: text/plain");
        header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

        for ($i = 0; $i < 1000; $i++) {
            echo ' ';
        }

        @ob_flush();
        @flush();
        call_user_func($printCallable);
        @ob_flush();
        @flush();
    }
}