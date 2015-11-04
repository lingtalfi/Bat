<?php

namespace Bat;

/*
 * LingTalfi 2015-10-07
 */
use CopyDir\AuthorCopyDirUtil;

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
     * Copies a directory to a given location.
     */
    public static function copyDir($src, $target, $preservePerms = false, &$errors = [])
    {
        $o = AuthorCopyDirUtil::create();
        $o->setPreservePerms($preservePerms);
        $ret = $o->copyDir($src, $target);
        $errors = $o->getErrors();
        return $ret;
    }


    /**
     * Returns true only if:
     * - dir exists
     * - file exists and is located under the dir
     *
     */
    public static function existsUnder($file, $dir)
    {
        if (false !== $rDir = realpath($dir)) {
            if (false !== $rFile = realpath($file)) {
                return ($rDir === substr($rFile, 0, strlen($rDir)));
            }
        }
        return false;
    }


    /**
     * Gets file permissions.
     * 
     * Returns:        
     * - false in case of failure
     * - if true === unix, str:permissions       ( -rw-r--r-- )
     * - if false === unix, str:permissions      ( 1777, 0644, ...)
     * 
     */
    public static function filePerms($file, $unix = true)
    {
        if (false !== ($perms = fileperms($file))) {
            if (false === $unix) {
                $ret = substr(sprintf('%o', $perms), -4);
            }
            else {

                if (($perms & 0xC000) == 0xC000) {
                    // Socket
                    $ret = 's';
                }
                elseif (($perms & 0xA000) == 0xA000) {
                    // Symbolic Link
                    $ret = 'l';
                }
                elseif (($perms & 0x8000) == 0x8000) {
                    // Regular
                    $ret = '-';
                }
                elseif (($perms & 0x6000) == 0x6000) {
                    // Block special
                    $ret = 'b';
                }
                elseif (($perms & 0x4000) == 0x4000) {
                    // Directory
                    $ret = 'd';
                }
                elseif (($perms & 0x2000) == 0x2000) {
                    // Character special
                    $ret = 'c';
                }
                elseif (($perms & 0x1000) == 0x1000) {
                    // FIFO pipe
                    $ret = 'p';
                }
                else {
                    // Unknown
                    $ret = 'u';
                }

                // Owner
                $ret .= (($perms & 0x0100) ? 'r' : '-');
                $ret .= (($perms & 0x0080) ? 'w' : '-');
                $ret .= (($perms & 0x0040) ?
                    (($perms & 0x0800) ? 's' : 'x') :
                    (($perms & 0x0800) ? 'S' : '-'));

                // Group
                $ret .= (($perms & 0x0020) ? 'r' : '-');
                $ret .= (($perms & 0x0010) ? 'w' : '-');
                $ret .= (($perms & 0x0008) ?
                    (($perms & 0x0400) ? 's' : 'x') :
                    (($perms & 0x0400) ? 'S' : '-'));

                // World
                $ret .= (($perms & 0x0004) ? 'r' : '-');
                $ret .= (($perms & 0x0002) ? 'w' : '-');
                $ret .= (($perms & 0x0001) ?
                    (($perms & 0x0200) ? 't' : 'x') :
                    (($perms & 0x0200) ? 'T' : '-'));
            }
            return $ret;
        }
        return false;
    }


    /**
     * Returns the file extension as defined here: https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.fileName.eng.md
     */
    public static function getFileExtension($file)
    {
        if (is_string($file)) {
            $file = basename($file);
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
     * Returns the file name as defined here: https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.fileName.eng.md
     */
    public static function getFileName($file)
    {
        if (is_string($file)) {
            $file = basename($file);
            if ('.' === $file[0]) {
                $p = explode('.', $file);
                if (count($p) > 2) {
                    array_pop($p);
                }
                return implode('.', $p);
            }
        }
        else {
            throw new \InvalidArgumentException(sprintf("file argument must be of type string, %s given", gettype($file)));
        }
        return pathinfo($file, PATHINFO_FILENAME);
    }


    /**
     * Returns the size in bytes of a given file.
     * The file can be an url starting with http:// https://, or a filesystem file.
     *
     * @return int|false in case of failure (file not existing for instance)
     */
    public static function getFileSize($file)
    {

        if (
            'http://' === substr($file, 0, 7) ||
            'https://' === substr($file, 0, 8)
        ) {
            if (true === extension_loaded('curl')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $file);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_NOBODY, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10); // mitigate slowloris attacks http://php.net/manual/en/function.get-headers.php#117189
                curl_exec($ch);
                return (int)curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
            }
            else {
                $head = array_change_key_case(get_headers($file, 1));
                return (int)$head['content-length'];
            }
        }
        else {
            return filesize($file);
        }
    }

    /**
     *
     * Ensures that a directory exists.
     *
     * It uses the same arguments as the php native mkdir function.
     * bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource $context ]]] )
     *
     *
     * It is considered a success when the dir exists and is a dir (not a file or a link),
     *      and there were no permissions errors.
     *
     * It is considered a failure otherwise.
     *
     *
     * This method returns true in case of success, and false in case of failure.
     * If a link or a file resides at the location where you want to create the dir, this
     * method will not try to remove the existing link or file and will fail.
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
     *
     * Ensures that a directory exists, or throws an exception if something wrong happens.
     *
     * It uses the same arguments as the php native mkdir function.
     * bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource $context ]]] )
     *
     *
     * It is considered a success when the dir exists and is a dir (not a file or a link),
     *      and there were no permissions errors.
     *
     * It is considered a failure otherwise.
     *
     *
     * This method returns true in case of success, and false in case of failure.
     * If a link or a file resides at the location where you want to create the dir, this
     * method will not try to remove the existing link or file and will fail.
     *
     * @return bool
     * @throws \Exception
     */
    public static function mkdirDone($pathName, $mode = 0777, $recursive = true)
    {
        if (4 === func_num_args()) {
            $ret = mkdir($pathName, $mode, $recursive, func_get_args()[3]);
        }
        else {
            $ret = mkdir($pathName, $mode, $recursive);
        }
        if (false === $ret) {
            throw new \Exception("Could not make dir $pathName");
        }
        return true;
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
