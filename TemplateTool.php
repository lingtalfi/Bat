<?php


namespace Ling\Bat;

use Ling\Bat\Exception\BatException;

/**
 * The TemplateTool class.
 */
class TemplateTool
{


    /**
     * Copies the source file to the destination, and replace the given variables by their values.
     *
     * The replacements array is an array of key/value pairs.
     *
     * The destination is always overwritten if it exists.
     *
     * Note: the replacements are done the same way as the php str_replace function (i.e. order matters).
     *
     *
     *
     *
     * @param string $srcFile
     * @param string $dstFile
     * @param array $replacements
     * @throws \Exception
     */
    public static function copy(string $srcFile, string $dstFile, array $replacements = []): void
    {
        if (false === file_exists($srcFile)) {
            throw new BatException("Source file not found: $srcFile.");
        }
        $c = file_get_contents($srcFile);
        $c = str_replace(array_keys($replacements), array_values($replacements), $c);
        FileSystemTool::mkfile($dstFile, $c);
    }
}