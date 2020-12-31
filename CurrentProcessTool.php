<?php


namespace Ling\Bat;

/**
 * The CurrentProcess class.
 */
class CurrentProcessTool
{


    /**
     * Returns whether the current process is executed under cli.
     *
     * @return bool
     */
    public static function isCli(): bool
    {
        return ('cli' === php_sapi_name());
    }

}