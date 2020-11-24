<?php

namespace Ling\Bat;


use Ling\CopyDir\AuthorCopyDirUtil;
use Ling\DirScanner\YorgDirScannerTool;


/**
 * The FileSystemTool class.
 * LingTalfi 2015-10-07 -> 2020-10-27
 */
class FileSystemTool
{


    /**
     *
     * Removes all the empty dirs under the given directory (recursively).
     *
     * @param $dir
     */
    public static function cleanDir(string $dir)
    {
        $dirs = YorgDirScannerTool::getDirs($dir, true);

        /**
         * It's better to have the leaves first, because it will also get rid of any parent that contains only empty folders.
         */
        $dirs = array_reverse($dirs);
        foreach ($dirs as $dir) {
            if (true === self::isEmptyDir($dir)) {
                self::remove($dir);
            }
        }
    }

    /**
     *
     * Check if the given dir is empty (i.e. does not contain any file/dir/link).
     * If this is the case, then remove the dir and cleanDirBubble the parent dir
     * recursively until the parent dir is not empty.
     *
     * @param $dir
     */
    public static function cleanDirBubble($dir)
    {
        if (0 === self::countFiles($dir)) {
            self::remove($dir);
            $parent = dirname($dir);
            if (is_dir($parent)) {
                self::cleanDirBubble($parent);
            }
        }
    }


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
     * By default, if the target is a symlink, the process will be aborted.
     * If you want to clear the symlink dir, set the $abortIfSymlink flag to false.
     *
     *
     *
     */
    public static function clearDir($file, $throwEx = true, $abortIfSymlink = true)
    {

        if (
            (
                false === $abortIfSymlink &&
                is_dir($file) && is_link($file)
            ) ||
            true === self::mkdir($file, 0777, true)
        ) {
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
     * Copy a file
     */
    public static function copyFile($src, $target)
    {
        self::mkdir(dirname($target), 0777, true);
        return copy($src, $target);
    }


    /**
     * Return the number of files/dirs/links of a given dir.
     *
     * https://stackoverflow.com/questions/12801370/count-how-many-files-in-directory-php
     * @param $dir
     * @return int
     */
    public static function countFiles($dir)
    {
        $fi = new \FilesystemIterator($dir, \FilesystemIterator::SKIP_DOTS);
        return iterator_count($fi);
    }

    /**
     * Returns true only if:
     * - dir exists
     * - file exists and is located under the dir
     *
     */
    public static function existsUnder($file, $dir)
    {
        if (false !== ($rDir = realpath($dir))) {
            if (false !== ($rFile = realpath($file))) {
                return ($rDir === substr($rFile, 0, strlen($rDir)));
            }
        }
        return false;
    }

    /**
     * Returns a generator function, which can iterate over the lines of the given file.
     */
    public static function fileGenerator($file, $ignoreTrailingNewLines = true)
    {
        return function () use ($file, $ignoreTrailingNewLines) {
            $f = fopen($file, 'r');
            try {
                while ($line = fgets($f)) {
                    if (true === $ignoreTrailingNewLines) {
                        yield rtrim($line, PHP_EOL);
                    } else {
                        yield $line;
                    }
                }
            } finally {
                fclose($f);
            }
        };
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
        return PermTool::filePerms($file, $unix);
    }


    /**
     * Returns the weight of the given directory in bytes.
     *
     *
     * https://stackoverflow.com/questions/478121/how-to-get-directory-size-in-php
     *
     *
     * @param string $path
     * @return int
     */
    public static function getDirectorySize(string $path): int
    {
        $bytestotal = 0;
        $path = realpath($path);
        if ($path !== false && $path != '' && file_exists($path)) {
            foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)) as $object) {
                $bytestotal += $object->getSize();
            }
        }
        return $bytestotal;
    }


    /**
     * Returns the file extension as defined here: https://github.com/lingtalfi/ConventionGuy/blob/master/nomenclature.fileName.eng.md
     *
     * If the file path has multiple extensions, only the last one will be returned.
     * If the file path has no extension or an empty extension, the empty string will be returned.
     *
     * Examples:
     *
     * - /www/htdocs/inc/lib.inc.php    --> "php"
     * - /path/emptyextension.          --> ""
     * - /path/noextension              --> ""
     *
     *
     *
     * @param string $file
     * @return string
     */
    public static function getFileExtension(string $file): string
    {
        if (is_string($file)) {
            $file = basename($file);
            if ('.' === $file[0]) {
                if ('.' === $file) {
                    return '';
                }
                $file = substr($file, 1);
            }
        } else {
            throw new \InvalidArgumentException(sprintf("file argument must be of type string, %s given", gettype($file)));
        }
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * Returns the [file name](https://github.com/lingtalfi/NotationFan/blob/master/filename-basename.md) of the given file path.
     *
     * @param string $file
     *
     * @return string
     * The file name without the last extension.
     *
     */
    public static function getFilename(string $file): string
    {
        return basename($file);
    }


    /**
     * Returns the [base name](https://github.com/lingtalfi/NotationFan/blob/master/filename-basename.md)) of the given path.
     *
     * If the file path has multiple extensions, only the last one will be cut off.
     *
     * Examples:
     *
     * - /www/htdocs/inc/lib.inc.php    --> "lib.inc"
     * - /path/emptyextension.          --> "emptyextension"
     * - /path/noextension              --> "noextension"
     *
     *
     *
     *
     * @param string $path
     * @return string
     */
    public static function getBasename(string $path): string
    {
        if (is_string($path)) {
            $path = basename($path);
            if ('.' === $path[0]) {
                $p = explode('.', $path);
                if (count($p) > 2) {
                    array_pop($p);
                }
                return implode('.', $p);
            }
        } else {
            throw new \InvalidArgumentException(sprintf("file argument must be of type string, %s given", gettype($path)));
        }
        return pathinfo($path, PATHINFO_FILENAME);
    }


    public static function getFileSize($file, $humanize = false)
    {
        return FileTool::getFileSize($file, $humanize);
    }


    /**
     * Returns the relative path (without the leading slash) from the given $rootDir to the given $absolutePath,
     * only if the $absolutePath file is located UNDER the rootDir.
     *
     * If not, this method returns false.
     *
     *
     *
     * @param string $absolutePath
     * @param string $rootDir
     * @return string|false
     */
    public static function getRelativePath(string $absolutePath, string $rootDir)
    {
        $absolutePath = realpath($absolutePath);
        $rootDir = realpath($rootDir);
        if (0 === strpos($absolutePath, $rootDir)) {
            $len = mb_strlen($rootDir);
            return mb_substr($absolutePath, $len + 1); // +1 to strip the slash
        }
        return false;
    }


    /**
     * Returns whether the given file and is under the given rootDir.
     * If the $checkFileExists is set, also checks whether the file exists.
     *
     * @param string $file
     * @param string $rootDir
     * @param bool $checkFileExists
     * @return bool
     */
    public static function isDirectoryTraversalSafe(string $file, string $rootDir, bool $checkFileExists = true): bool
    {
        $realFile = realpath($file);
        if (false === $realFile || 0 !== strpos($realFile, realpath($rootDir))) {
            return false;
        }
        if (true === $checkFileExists) {
            return file_exists($file);
        }
        return true;
    }


    /**
     * Returns whether the given directory is empty (i.e. contains no files, links or directories).
     *
     * @param string $dir
     * @return bool
     */
    public static function isEmptyDir(string $dir): bool
    {
        return (0 === self::countFiles($dir));
    }

    /**
     * Returns whether the given filename is considered valid.
     * A filename is considered valid only if all conditions below are fulfilled:
     *
     * - the filename is not an empty string
     * - the filename is different than ".."
     * - the filename doesn't start and/or end with a space
     * - the filename doesn't contain one of the following characters: /?*:;{}\
     *
     * Actually, the filename can contain the slash char (/) if the $acceptSlash argument is set to true.
     *
     *
     *
     * @param string $filename
     * @param bool $acceptSlash = false
     * @return bool
     */
    public static function isValidFilename(string $filename, bool $acceptSlash = false): bool
    {
        if ("" === $filename) {
            return false;
        }
        if ('..' === $filename) {
            return false;
        }
        if (preg_match('!(^ | $)!', $filename)) {
            return false;
        }

        if (false === $acceptSlash) {
            $regex = '![/?*:;{}\\\]!';
        } else {
            $regex = '![?*:;{}\\\]!';
        }

        if (preg_match($regex, $filename)) {
            return false;
        }

        return true;
    }


    /**
     *
     * Ensures that a directory exists.
     *
     * It uses the same arguments as the php native mkdir function.
     * bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource $context ]]] )
     *
     *
     * It is considered a success when the dir exists and is a dir (not a file), and there were no permissions errors.
     *
     * It is considered a failure otherwise.
     *
     *
     * This method returns true in case of success, and false in case of failure.
     * If a link or a file resides at the location where you want to create the dir, this
     * method will not try to remove the existing link or file and will fail.
     *
     */
    public static function mkdir($pathName, $mode = 0777, $recursive = true)
    {
        if (file_exists($pathName) && is_dir($pathName)) {
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
        } else {
            $ret = mkdir($pathName, $mode, $recursive);
        }
        if (false === $ret) {
            throw new \Exception("Could not make dir $pathName");
        }
        return true;
    }


    /**
     *
     * Creates a file, and the intermediary directories if necessary.
     *
     * @return bool,
     *      true if the file exists when the method has been executed
     *      false if the file couldn't be created
     */
    public static function mkfile($pathName, $data = '', $dirMode = 0777, $mode = 0)
    {
        if (true === FileSystemTool::mkdir(dirname($pathName), $dirMode, true)) {
            if (false !== file_put_contents($pathName, $data, $mode)) {
                return true;
            }
        }
        return false;
    }


    /**
     * Creates a temporary file with the given content, and return its path.
     *
     * @param string $content
     * @param string|null $prefix
     * @param string|null $extension
     * @return false|string
     */
    public static function mkTmpFile(string $content, string $prefix = null, string $extension = null)
    {
        if (null === $prefix) {
            $prefix = 'Bat-';
        }
        $path = tempnam(sys_get_temp_dir(), $prefix);
        if (null !== $extension) {
            $path .= "." . $extension;
        }
        self::mkfile($path, $content);
        return $path;
    }


    /**
     * Makes a temporary copy of the given file path.
     * A filename can be provided.
     *
     *
     * @param string $path
     * @param string|null $filename = null
     * @return string
     */
    public static function mkTmpCopy(string $path, string $filename = null): string
    {
        $tmp = tempnam(sys_get_temp_dir(), "");


        $dst = $tmp;
        $newLocation = false;
        if (null !== $filename) {
            $dir = dirname($dst);
            $dst = $dir . "/" . $filename;
            $newLocation = true;
        }

        self::copyFile($path, $dst);
        if (true === $newLocation) {
            unlink($tmp);
        }
        return $dst;
    }


    public static function move(string $src, string $dst)
    {
        return self::rename($src, $dst);
    }

    public static function moveToDir(string $filePath, string $directory)
    {
        $newPath = rtrim($directory, "/") . "/" . basename($filePath);
        return self::rename($filePath, $newPath);
    }


    /**
     * Returns the given $path with the tilde resolved (to the user home directory).
     *
     *
     * @param string $path
     * @return mixed
     */
    public static function resolveTilde(string $path)
    {
        $user = exec('whoami');
        if (OsTool::isMac()) {
            $tildeReplacement = "/Users/$user";
        } elseif (OsTool::isWindows()) {
            // not tested: I don't have a windows
            $tildeReplacement = "C:\\Document and Settings\\$user";
        } else {
            $tildeReplacement = "/home/$user";
        }

        return str_replace('~', $tildeReplacement, $path);
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
            } else {
                return true;
            }
        } else {
            if (false === unlink($file)) {
                return self::_oops("Cannot remove link $file", $throwEx);
            }
            return true;
        }
    }


    /**
     * Removes the (last) file extension from the given $file and returns the result.
     *
     * If the file starts with a dot (like .htaccess), what follows the first dot is not considered as an extension.
     *
     *
     * Examples:
     *
     * - .htaccess => .htaccess
     * - file.md => file
     * - file.tpl.php => file.tpl
     *
     *
     */
    public static function removeExtension(string $file): string
    {
        $pos = strpos($file, ".");
        if (false !== $pos) {
            if (0 === $pos) {
                return $file;
            }
            $p = explode(".", $file);
            array_pop($p);
            return implode('.', $p);
        }
        return $file;

    }


    /**
     * Replaces the double dot (..) traversal string from the given path with an empty string, and returns the result.
     * @param string $path
     * @return string
     */
    public static function removeTraversalDots(string $path): string
    {
        return str_replace("..", "", $path);
    }


    /**
     * Will rename src to dst, creating dst subdirs if necessary
     */
    public static function rename($src, $dst)
    {
        $dstDir = dirname($dst);
        FileSystemTool::mkdir($dstDir, 0777, true);
        return rename($src, $dst);
    }


    /**
     * http://stackoverflow.com/questions/1707801/making-a-temporary-dir-for-unpacking-a-zipfile-into
     */
    public static function tempDir($dir = null, $prefix = null)
    {
        if (null === $dir) {
            $dir = sys_get_temp_dir();
        }
        if (null === $prefix) {
            $prefix = '';
        }
        $tempfile = tempnam($dir, $prefix);
        if (file_exists($tempfile)) {
            unlink($tempfile);
        }
        mkdir($tempfile);
        if (is_dir($tempfile)) {
            return $tempfile;
        }
        return false;
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
            } elseif (2 === $n) {
                $ret = touch($fileName, func_get_arg(1));
            } elseif (3 === $n) {
                $ret = touch($fileName, func_get_arg(1), func_get_arg(2));
            }
            if (false === $ret) {
                throw new \Exception("Could not touch the file $fileName");
            }
        } else {
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
            } else {
                return self::_oops("Cannot remove unreadable dir $file", $throwEx);
            }
        } else {
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
