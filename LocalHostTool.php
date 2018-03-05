<?php

namespace Bat;

/*
 * LingTalfi 2015-10-09
 */
class LocalHostTool
{




    /**
     * @param $program, the absolute path to the program
     * @return bool
     * @throws \Exception
     */
    public static function hasProgram($program)
    {
        if (true === self::isUnix()) {
            ob_start();
            passthru("which $program");
            return (strlen(ob_get_clean()) > 0);
        }
        else {
            // todo: implement for windows...
            throw new \Exception("Sorry dude, not implemented now for windows machine, please improve this class");
        }
    }


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
