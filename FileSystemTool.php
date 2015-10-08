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


    /**
     *
     * Works like php's native touch function, except that intermediate dirs are created if necessary,
     * and that the method throws an Exception if something goes wrong.
     *
     * bool touch ( string $filename [, int $time = time() [, int $atime ]] )
     *
     */
    public static function touchDone($fileName)
    {
        if (is_string($fileName)) {
            $dir = dirname($fileName);
            if (false === FileSystemTool::mkdir($dir, 0777, true)) {
                throw new \Exception("Could not create dir: $dir");
            }
            $n = func_num_args();
            if (1 === $n) {
                $ret = touch($fileName);
            }
            elseif (2 === $n) {
                $ret = touch($fileName, func_get_arg(1));
            }
            elseif (3 === $n) {
                $ret = touch($fileName, func_get_arg(1), func_get_arg(2));
            }
            if (false === $ret) {
                throw new \Exception("Could not touch the file $fileName");
            }
        }
        else {
            throw new \InvalidArgumentException(sprintf("fileName argument must be of type string, %s given", gettype($fileName)));
        }
    }
}
