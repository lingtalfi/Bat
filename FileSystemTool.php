<?php

namespace Bat;

/*
 * LingTalfi 2015-10-07
 */
class FileSystemTool
{


    /**
     * Ensures that a directory exist and is empty.
     *
     * It is considered a success if the directory exists and is empty, and a failure otherwise.
     *
     * By default, the method throws an exception in case of failure.
     *
     * If you set the throwEx flag to false, then this method will return true in case of success,
     * and false in case of failure.
     *
     *
     */
    public static function clearDir($file, $throwEx = true)
    {
        if (true === self::mkdir($file, 0777, true)) {
            $files = new \FilesystemIterator($file,
                \FilesystemIterator::KEY_AS_PATHNAME |
                \FilesystemIterator::CURRENT_AS_FILEINFO |
                \FilesystemIterator::SKIP_DOTS
            );
            foreach ($files as $f) {
                if (false === self::_remove($f, $throwEx)) {
                    return false;
                }
            }
            return true;
        }
        return self::_oops("Cannot create the dir $file", $throwEx);
    }


    /**
     * Returns the file extension:
     *
     * hello.txt            -> txt
     * hello.tXT            -> tXT
     * hello.tar.gz         -> gz
     * .htaccess            -> <empty string>
     * .htaccess.tar.gz     -> gz
     * hello                -> <empty string>
     *
     */
    public static function getFileExtension($file)
    {
        if (is_string($file)) {
            if ('.' === $file[0]) {
                if ('.' === $file) {
                    return '';
                }
                $file = substr($file, 1);
            }
        }
        else {
            throw new \InvalidArgumentException(sprintf("file argument must be of type string, %s given", gettype($file)));
        }
        return pathinfo($file, PATHINFO_EXTENSION);
    }


    /**
     *
     * Ensures that a directory exists.
     *
     * It uses the same arguments as the php native mkdir function.
     * bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource $context ]]] )
     *
     *
     * It is considered a success when the dir exists and is a dir (not a file or a link).
     * It is considered a failure otherwise.
     *
     *
     * This method returns true in case of success, and false in case of failure.
     *
     */
    public static function mkdir($pathName, $mode = 0777, $recursive = false)
    {
        if (file_exists($pathName) && is_dir($pathName) && !is_link($pathName)) {
            return true;
        }
        if (4 === func_num_args()) {
            return mkdir($pathName, $mode, $recursive, func_get_args()[3]);
        }
        return mkdir($pathName, $mode, $recursive);
    }


    /**
     * Removes an entry from the filesystem.
     * The entry can be:
     *
     * - a link, then the link only is removed (not the target)
     * - a file, then the file is removed
     * - a directory, the the directory is removed recursively
     *
     * It is considered a success when the entry doesn't exist on the filesystem at the end,
     * and a failure otherwise.
     *
     * By default, the method throws an exception in case of failure.
     *
     * If you set the throwEx flag to false, then this method will return true in case of success,
     * and false in case of failure.
     *
     */
    public static function remove($file, $throwEx = true)
    {
        if (false === is_link($file)) {
            if (file_exists($file)) {
                return self::_remove($file, $throwEx);
            }
            else {
                return true;
            }
        }
        else {
            if (false === unlink($file)) {
                return self::_oops("Cannot remove link $file", $throwEx);
            }
            return true;
        }
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


    //------------------------------------------------------------------------------/
    // 
    //------------------------------------------------------------------------------/
    private static function _oops($m, $throwEx = true)
    {
        if (true === $throwEx) {
            throw new \Exception($m);
        }
        return false;
    }

    private static function _remove($file, $throwEx = true)
    {
        if (is_dir($file) && !is_link($file)) {
            if (is_readable($file)) {
                $files = new \FilesystemIterator($file,
                    \FilesystemIterator::KEY_AS_PATHNAME |
                    \FilesystemIterator::CURRENT_AS_FILEINFO |
                    \FilesystemIterator::SKIP_DOTS
                );
                foreach ($files as $f) {
                    self::_remove($f, $throwEx);
                }
                if (false === rmdir($file)) {
                    return self::_oops("Cannot remove dir $file", $throwEx);
                }
                return true;
            }
            else {
                return self::_oops("Cannot remove unreadable dir $file", $throwEx);
            }
        }
        else {
            if (true === is_file($file) || true === is_link($file)) {
                if (false === unlink($file)) {
                    if (true === is_link($file)) {
                        return self::_oops("Cannot remove link $file", $throwEx);
                    }
                    return self::_oops("Cannot remove file $file", $throwEx);
                }
                return true;
            }
        }
    }
}
