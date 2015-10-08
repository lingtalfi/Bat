<?php

namespace Bat;

/*
 * LingTalfi 2015-10-07
 */
class FileSystemTool
{

    /**
     *
     * bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource $context ]]] )
     *
     * Returns true if the given dir exists when the function exits
     * or false if for some reason the given dir couldn't be created.
     */
    public static function mkdir($pathName, $mode = 0777, $recursive = false)
    {
        if (file_exists($pathName)) {
            return true;
        }
        if (4 === func_num_args()) {
            return @mkdir($pathName, $mode, $recursive, func_get_args()[3]);
        }
        return @mkdir($pathName, $mode, $recursive);
    }
}
