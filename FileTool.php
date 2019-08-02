<?php

namespace Ling\Bat;


/**
 * The FileTool class.
 */
class FileTool
{


    public static function append($msg, $file)
    {
        if (file_exists($file)) {
            file_put_contents($file, $msg, FILE_APPEND);
        } else {
            FileSystemTool::mkfile($file, $msg, 0777, 0);
        }
    }


    public static function cleanVerticalSpaces($file, $maxConsecutiveBlankLines = 3)
    {
        $maxConsecutiveBlankLines++;
        $r = str_repeat(PHP_EOL, $maxConsecutiveBlankLines);
        $c = file_get_contents($file);
        $n = $maxConsecutiveBlankLines + 1;
        $c = preg_replace('!(\n(\r?\s)*){' . $n . ',}!', $r, $c);
        file_put_contents($file, $c);
    }

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
     * Returns the size in bytes of a given file.
     * The file can be an url starting with http:// https://, or a filesystem file.
     *
     * @return int|false in case of failure (file not existing for instance)
     */
    public static function getFileSize(string $file, bool $humanize = false)
    {

        $sizeInBytes = 0;
        if (
            'http://' === substr($file, 0, 7) ||
            'https://' === substr($file, 0, 8)
        ) {
            if (true === extension_loaded('curl')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $file);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_NOBODY, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10); // mitigate slowloris attacks http://php.net/manual/en/function.get-headers.php#117189
                curl_exec($ch);
                $sizeInBytes = (int)curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
            } else {
                $head = array_change_key_case(get_headers($file, 1));
                $sizeInBytes = (int)$head['content-length'];
            }
        } else {
            $sizeInBytes = filesize($file);
        }
        if (false === $sizeInBytes) {
            return $sizeInBytes;
        }
        if (true === $humanize) {
            return ConvertTool::convertBytes($sizeInBytes, "h");
        }
        return $sizeInBytes;
    }


    /**
     * Returns whether the given file is an image (based on the guessed mime type).
     *
     * @param string $filePath
     * @return bool
     */
    public static function isImage(string $filePath): bool
    {
        $finfo = new \finfo();
        $fileMimeType = $finfo->file($filePath, FILEINFO_MIME_TYPE);
        return (0 === strpos($fileMimeType, "image/"));
    }

    /**
     * Prepends the given $text to the given $file and returns
     * whether the operation was successful.
     *
     * @param string $file
     * @param string $text
     * @return bool
     */
    public static function prepend(string $file, string $text): bool
    {
        if (file_exists($file)) {
            $content = file_get_contents($file);
            $content = $text . $content;
            return FileSystemTool::mkfile($file, $content);
        } else {
            return FileSystemTool::mkfile($file, $text, 0777, 0);
        }
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
     * Cut a file from line startLine to endLine, and either returns two parts (if replaceFile is false):
     * - the part before the startLine,
     * - the part after the endLine
     *
     * Or actually do the cut in the file (if replaceFile is true).
     *
     *
     * @return array, the two parts around (before and after) the cut as an array
     */
    public static function cut($file, $startLine, $endLine, $replaceFile = false)
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
        if (true === $replaceFile) {
            file_put_contents($file, $a . $b);
        }
        return [$a, $b];
    }


    /**
     *
     * Take a file, extract all the slices from it, and return the result.
     * It will also save the file with the actual changes done, if replaceFile is true.
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
    public static function extract($file, array $slices, $replaceFile = false)
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
        $ret = implode("", $lines);
        if (true === $replaceFile) {
            file_put_contents($file, $ret);
        }
        return $ret;
    }

    /**
     * Inserts the given content at the given lineNumber for the file.
     * If the given lineNumber is greater than the number of lines in the file,
     * the content will be appended to the existing file, prefixed with a newline.
     *
     */
    public static function insert($lineNumber, $content, $file)
    {
        if ($lineNumber > 0) {
            $lines = file($file);

            // we add +1 because to allow appending to the last line
            $max = count($lines) + 1;
            if ($lineNumber > $max) {
                $lineNumber = $max;
            }

            $index = $lineNumber - 1;
            $a = array_slice($lines, 0, $index);
            $b = array_slice($lines, $index);

            $c = implode("", $a);
            if ($max === $lineNumber && empty($b)) {
                $c .= PHP_EOL;
            }
            $c .= $content;
            $c .= implode("", $b);

            FileSystemTool::mkfile($file, $c);
        } else {
            throw new \Exception("the lineNumber must be greater than 0");
        }
    }
}
