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


        $a = implode("", $a);
        $b = implode("", $b);
        return [$a, $b];
    }


    /**
     * Cut a file from line startLine to endLine, and returns two parts:
     * - the part before the startLine,
     * - the part after the endLine
     *
     *
     * @return array, the two parts around (before and after) the cut as an array
     */
    public static function cut($file, $startLine, $endLine)
    {
        $lines = file($file);
        if ($startLine < 1) {
            throw new \Exception("startLine number must be greater than 0");
        }
        if ($endLine > count($lines)) {
            $count = count($lines);
            throw new \Exception("endLine number must be lower than $count");
        }


        $startLine--;
        $a = array_slice($lines, 0, $startLine);
        $b = array_slice($lines, $endLine);


        $a = implode("", $a);
        $b = implode("", $b);
        return [$a, $b];
    }


    /**
     *
     * Take a file, extract all the slices from it, and return the result.
     *
     * Each slice is an array:
     *      - 0: startLine of the part to cut
     *      - 1: endLine of the part to cut
     *
     *
     * Slices must not overlap.
     *
     * @return string, the extracted content
     */
    public static function extract($file, array $slices)
    {
        $lines = file($file);
        $max = count($lines);

        usort($slices, function ($a, $b) {
            return ($a[0] < $b[0]);
        });

        foreach ($slices as $slice) {
            list($startLine, $endLine) = $slice;
            if ($startLine < 1) {
                throw new \Exception("startLine number must be greater than 0");
            }
            if ($endLine > $max) {
                throw new \Exception("endLine number must be lower than $max");
            }

            $startLine--;

            $a = array_slice($lines, 0, $startLine);
            $b = array_slice($lines, $endLine);

            $lines = array_merge($a, $b);
        }
        return implode("", $lines);
    }
}
