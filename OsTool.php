<?php

namespace Ling\Bat;


/**
 * The OsTool class.
 */
class OsTool
{


    /**
     * Returns whether or not the program exists on the machine.
     *
     * @param string $program , the absolute path to the program
     * @return bool
     * @throws \Exception
     */
    public static function hasProgram(string $program)
    {
        if (true === self::isUnix()) {
            ob_start();
            passthru("which $program");
            return (strlen(ob_get_clean()) > 0);
        } else {
            // todo: implement for windows...
            throw new \Exception("Sorry dude, not implemented now for windows machine, please improve this class");
        }
    }


    /**
     * Returns whether the current machine is running on Windows OS.
     *
     * @return bool
     */
    public static function isWindows()
    {
        return (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
    }


    /**
     * Returns whether the current machine is running on Mac OS.
     *
     * @return bool
     */
    public static function isMac()
    {
        return (strtoupper(substr(PHP_OS, 0, 6)) === 'DARWIN');
    }


    /**
     * Returns whether the current machine is running on a Unix OS.
     *
     * @return bool
     */
    public static function isUnix()
    {
        /**
         * If it's not windows, it's unix, isn't it?
         */
        return (false === self::isWindows());
    }


    /**
     * Clears the console screen.
     */
    public static function clear()
    {
        if (true === self::isWindows()) {
            // https://stackoverflow.com/questions/24327544/how-can-clear-screen-in-php-cli-like-cls-command
            // didn't test personally
            system('cls');
        } else {
            system('clear');
        }
    }
}