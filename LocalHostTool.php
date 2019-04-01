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
}
