<?php


namespace Ling\Bat;


/**
 * The ConsoleTool class.
 */
class ConsoleTool
{


    /**
     * Executes the given $cmd command, and returns the captured output (what was written on STD_OUT).
     * The $return variable will contain the return code of the command. It will be integer 0 if the command
     * was successful.
     *
     *
     * @param string $cmd
     * @param int $return
     * @return string
     */
    public static function capture(string $cmd, int &$return = 0): string
    {
        $outputLines = [];
        exec($cmd, $outputLines, $return);
        return implode(PHP_EOL, $outputLines);
    }


    /**
     * Executes the given $cmd command, and returns whether it was successful.
     * The $outputLines variable will contain all lines (as an array) written on STD_OUT by the command.
     *
     *
     * @param string $cmd
     * @param array $outputLines
     * @param int $return
     * @return bool
     */
    public static function exec(string $cmd, array &$outputLines = [], int &$return = 0): bool
    {
        $return = 0;
        exec($cmd, $outputLines, $return);
        return ($return === 0);
    }


    /**
     * Returns the user home directory if found, or null otherwise.
     *
     * Note: this should only works on mac and unix machines, not windows.
     *
     *
     *
     * @return string|null
     */
    public static function getUserHomeDirectory(): ?string
    {
        $ret = null;
        if (array_key_exists("HOME", $_SERVER)) {
            return $_SERVER['HOME'];
        }
        return $ret;
    }

    /**
     * Executes the php passthru function, and returns whether the command was successful.
     *
     * @param string $cmd
     * @return bool
     */
    public static function passThru(string $cmd): bool
    {
        $return = 0;
        passthru($cmd, $return);
        return (0 === $return);
    }


    /**
     * Resets the terminal screen.
     *
     * https://linoxide.com/commands-clear-linux-terminal/
     *
     */
    public static function reset()
    {
        echo "\033c"; // this is blazing fast
//        self::exec('reset'); // this is stupid slow
    }
}