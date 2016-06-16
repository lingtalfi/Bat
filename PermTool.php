<?php

namespace Bat;

/*
 * LingTalfi 2016-06-16
 * You need to be root to use any of those methods.
 */
class PermTool
{

    
    /**
     * @param string $target
     * @param string|octal $mode , like 0777
     * @param bool $isRecursive
     * @return bool
     */
    public static function chmod($target, $mode, $isRecursive = true)
    {
        // default php proxy
        if (false === $isRecursive) {
            return chmod($target, $mode);
        }

        if (is_string($mode)) {
            $mode = octdec($mode);
        }

        return self::applyRecursive($target, function ($path) use ($mode) {
            return chmod($path, $mode);
        });
    }




    /**
     * @param string $target
     * @param string|int $owner
     * @param string|int|null $ownerGroup : if null, no group will be set
     * @param bool $isRecursive
     * @return bool
     */
    public static function chown($target, $owner, $ownerGroup = null, $isRecursive = true)
    {
        // default php proxy
        if (false === $isRecursive) {
            if (null === $ownerGroup) {
                return chown($target, $owner);
            }
            return chown($target, $owner) && chgrp($target, $ownerGroup);
        }

        // recursive section
        if (is_numeric($owner)) {
            $owner = (int)$owner;
        }
        if (is_numeric($ownerGroup)) {
            $ownerGroup = (int)$ownerGroup;
        }
        return self::applyRecursive($target, function ($path) use ($owner, $ownerGroup) {

            if (true === chown($path, $owner)) {
                if (
                    null === $ownerGroup ||
                    (
                        null !== $ownerGroup &&
                        true === chgrp($path, $ownerGroup)
                    )
                ) {
                    return true;
                }
            }
            return false;
        });
    }


    /**
     * Combination of chmod and chown.
     *
     *
     * @param string $target
     * @param string|int $owner
     * @param string|octal $mode , like 0777
     * @param string|int|null $ownerGroup : if null, no group will be set
     * @param bool $isRecursive
     * @return bool
     */
    public static function chperms($target, $mode, $owner, $ownerGroup = null, $isRecursive = true)
    {
        // default php proxy
        if (false === $isRecursive) {
            if (null === $ownerGroup) {
                return chmod($target, $mode) && chown($target, $owner);
            }
            return chmod($target, $mode) && chown($target, $owner) && chgrp($target, $ownerGroup);
        }

        // recursive section
        if (is_numeric($owner)) {
            $owner = (int)$owner;
        }
        if (is_numeric($ownerGroup)) {
            $ownerGroup = (int)$ownerGroup;
        }

        if (is_string($mode)) {
            $mode = octdec($mode);
        }



        return self::applyRecursive($target, function ($path) use ($owner, $ownerGroup, $mode) {

            if (true === chown($path, $owner)) {
                if (
                    null === $ownerGroup ||
                    (
                        null !== $ownerGroup &&
                        true === chgrp($path, $ownerGroup)
                    )
                ) {
                    return chmod($path, $mode);
                }
            }
            return false;
        });
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

    
    

    //------------------------------------------------------------------------------/
    // 
    //------------------------------------------------------------------------------/
    /**
     * @param $path
     * @param bool callable $fn
     * @return bool
     */
    private static function applyRecursive($path, callable $fn)
    {
        if (!is_dir($path)) {
            return $fn($path);
        }

        $dh = opendir($path);
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..') {
                $fullpath = $path . '/' . $file;
                if (is_link($fullpath)) {
                    return false;
                }
                elseif (!is_dir($fullpath) && !$fn($fullpath)) {
                    return false;
                }
                elseif (!self::applyRecursive($fullpath, $fn)) {
                    return false;
                }
            }
        }

        closedir($dh);

        if ($fn($path)) {
            return true;
        }
        else {
            return false;
        }
    }
}
