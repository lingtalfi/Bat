<?php

namespace Ling\Bat;


/**
 * The LocalHostTool class.
 * LingTalfi 2015-10-09
 */
class LocalHostTool
{


    /**
     * Alias for OsTool::hasProgram method.
     */
    public static function hasProgram(string $program)
    {
        return OsTool::hasProgram($program);
    }

    /**
     * Alias for OsTool::isWindows method.
     */
    public static function isWindows()
    {
        return OsTool::isWindows();
    }

    /**
     * Alias for OsTool::isMac method.
     */
    public static function isMac()
    {
        return OsTool::isMac();
    }

    /**
     * Alias for OsTool::isUnix method.
     */
    public static function isUnix()
    {
        return OsTool::isUnix();
    }


    /**
     * Returns the composer path if found, or false otherwise.
     *
     * Note: this method test paths based on my own experience, but I didn't read the docs...
     *
     * Use at your own risks.
     *
     * @return string|false
     */
    public static function getComposerPath(): string|false
    {
        $possiblePaths = [
            "/usr/local/bin/composer.phar",
        ];
        foreach ($possiblePaths as $path) {
            if (true === file_exists($path)) {
                return $path;
            }
        }


        return false;
    }
}
