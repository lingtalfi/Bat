<?php

namespace Bat;


class FileTool
{

    public static function getNbLines($file)
    {
        $linecount = 0;

        $m = exec('which wc');
        if ('' !== $m) {
            $cmd = 'wc -l < "' . str_replace('"', '\\"', $file) . '"';
            $n = exec($cmd);
            return (int)$n + 1;
        }


        $handle = fopen($file, "r");
        while (!feof($handle)) {
            $line = fgets($handle);
            $linecount++;
        }
        fclose($handle);
        return $linecount;
    }


    /**
     * Split a file in two parts, at the given lineNumber , and return the two parts.
     * The line indicated by lineNumber is part of the second half (not the first half).
     */
    public static function split($file, $lineNumber)
    {
        $lines = file($file);
        if ($lineNumber < 1) {
            throw new \Exception("Line number must be greater than 0");
        }
        $lineNumber--;
        $a = array_slice($lines, 0, $lineNumber);
        $b = array_slice($lines, $lineNumber);


        $a = implode(PHP_EOL, $a);
        $b = implode(PHP_EOL, $b);
        return [$a, $b];
    }
}
