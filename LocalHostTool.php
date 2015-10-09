<?php

namespace Bat;

/*
 * LingTalfi 2015-10-09
 */
class LocalHostTool
{
    
    
    
    public static function isWindows()
    {
        return (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
    }

    public static function isMac()
    {
        return (strtoupper(substr(PHP_OS, 0, 6)) === 'DARWIN');
    }

    public static function isUnix()
    {
        /**
         * If it's not windows, it's unix, isn't it?
         */
        return (false === self::isWindows());
    }
}
