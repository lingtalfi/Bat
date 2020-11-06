<?php

namespace Ling\Bat;

use Ling\Bat\Exception\BatException;
use Ling\DirScanner\YorgDirScannerTool;

/**
 * The ZipTool class.
 */
class ZipTool
{


    /**
     *
     * Extracts the given zip file as the given target directory, and returns whether the operation was successful.
     * If target is null, then the zip will be extracted in a directory of the same name as the zip file but without the zip extension.
     *
     * Examples
     * -------------
     *
     * ### If archive.zip file contains a directory containing two files:
     *      - a.txt
     *      - b.txt
     *
     * Then:
     *
     * - Bat::unzip( /my/archive.zip, /path/to/target )
     *      results in:
     *              - /path/to/target/a.txt
     *              - /path/to/target/b.txt
     *
     * - Bat::unzip( /my/archive.zip )
     *      results in:
     *              - /my/archive/a.txt
     *              - /my/archive/b.txt
     *
     * ### If archive.zip file contains a single file named a.txt:
     *
     * Then:
     *
     * - Bat::unzip( /my/archive.zip, /path/to/target )
     *      results in:
     *              - /path/to/target/a.txt
     *
     * - Bat::unzip( /my/archive.zip )
     *      results in:
     *              - /my/archive/a.txt
     *
     *
     *
     *
     *
     *
     * Source: https://stackoverflow.com/questions/8889025/unzip-a-file-with-php
     *
     *
     * @param $zipFile
     * @param $target =null
     *
     * @return bool
     * @throws BatException
     */
    public static function unzip($zipFile, $target = null)
    {
        if (false === extension_loaded('zip')) {
            throw new BatException("Extension not loaded: zip");
        }

        if (false === file_exists($zipFile)) {
            throw new BatException("File doesn't exist: $zipFile");
        }

        if (null === $target) {
            // get the absolute path to $file
            $target = pathinfo(realpath($zipFile), PATHINFO_DIRNAME) . "/" . FileSystemTool::getBasename($zipFile);
        }

        $zip = new \ZipArchive();
        $res = $zip->open($zipFile);
        if ($res === TRUE) {
            // extract it to the path we determined above
            $zip->extractTo($target);
            return $zip->close();
        }
        return false;
    }


    /**
     * Creates a zip file from the given source, and returns whether the operation was successful.
     *
     * Source can be either a simple file or a directory (in which case all it will be added recursively to the zip file).
     * Note: this method creates the necessary subdirectories for the zip file if necessary.
     *
     *
     * If the zip file already exists, it will be overwritten.
     *
     *
     * Source:
     * https://stackoverflow.com/questions/1334613/how-to-recursively-zip-a-directory-in-php
     *
     *
     *
     * @param string $source
     * The entry to add to the zip. It can be either a file or a directory
     *
     * @param string $zipFileName
     * The filename of the zip file
     *
     * @param array $options
     * - ignoreHidden: bool=false. Whether to ignore files/dirs which name starts with a dot (.), provided that the given source is a directory.
     * - ignoreName: array=[]. An array of file/directory names to ignore (provided that the given source is a directory).
     *          If a directory matches, the entire directory and its content will be ignored recursively.
     *
     * - ignorePath: array=[]. An array of file/directory relative paths to ignore (provided that the given source is a directory).
     *          If a directory matches, the entire directory and its content will be ignored recursively.
     *          Note: a relative path doesn't start with a slash.
     *
     *
     * @return bool
     * @throws BatException
     */
    public static function zip(string $source, string $zipFileName, array $options = [])
    {
        if (false === extension_loaded('zip')) {
            throw new BatException("Extension not loaded: zip");
        }

        if (false === file_exists($source)) {
            throw new BatException("File doesn't exist: $source");
        }


        $ignoreHidden = $options['ignoreHidden'] ?? false;
        $ignoreName = $options['ignoreName'] ?? [];
        $ignorePath = $options['ignorePath'] ?? [];


        $dir = dirname($zipFileName);
        FileSystemTool::mkdir($dir);


        $zip = new \ZipArchive();
        if (!$zip->open($zipFileName, \ZipArchive::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true) {


            $files = YorgDirScannerTool::getFilesIgnoreMore($source, $ignoreName, $ignorePath, true, false, false, $ignoreHidden);

            foreach ($files as $file) {
                $file = str_replace('\\', '/', $file);
                $file = realpath($file);

                if (true === is_dir($file)) {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else if (is_file($file) === true) {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }

            }

        } else if (is_file($source) === true) {
            $zip->addFromString(basename($source), file_get_contents($source));
        }

        return $zip->close();
    }


    /**
     * Creates a zip archive based on the given relative paths,
     * and returns whether the operation was a success.
     *
     * If the file exists, it will be overwritten.
     *
     *
     *
     *
     * @param string $dstZipFile
     * The name (path) of the zip file to create.
     *
     *
     * @param string $rootDir
     * The root dir, base of all relative paths.
     *
     * @param array $relativePaths
     * An array of relative paths (relative to the given $rootDir) to include in the archive.
     * If the relative path is a directory, the directory will be included in the archive with its content (recursively).
     *
     * @param array $errors
     * An array of errors that might occur.
     *
     * @param array $failed
     * An array of file relative paths which transfer to the archive failed.
     *
     *
     * @return bool
     * @throws BatException
     */

    public static function zipByPaths(string $dstZipFile, string $rootDir, array $relativePaths, array &$errors = [], array &$failed = []): bool
    {

        if (false === extension_loaded('zip')) {
            throw new BatException("Extension not loaded: zip");
        }


        $zip = new \ZipArchive();


        FileSystemTool::remove($dstZipFile);


        $res = $zip->open($dstZipFile, \ZipArchive::CREATE);
        if (true === $res) {
            if ($relativePaths) {

                foreach ($relativePaths as $rpath) {
                    $apath = $rootDir . "/" . $rpath;
                    if (is_file($apath)) {
                        $res = $zip->addFile($apath, $rpath);
                        if (false === $res) {
                            $failed[] = $rpath;
                        }
                    } elseif (is_dir($apath)) {
                        $files = YorgDirScannerTool::getFiles($apath, true, true, false, false);
                        foreach ($files as $_rpath) {
                            $newRpath = "$rpath/$_rpath";
                            $apath = $rootDir . "/" . $newRpath;
                            $res = $zip->addFile($apath, $newRpath);
                            if (false === $res) {
                                $failed[] = $newRpath;
                            }
                        }
                    } else {
                        $failed[] = $rpath;
                    }
                }

                $res = $zip->close();
                return $res && empty($failed);
            } else {
                $errors[] = "You must add at least one file in the zip archive.";
            }

        } else {
            $errors[] = "A ZipArchive error occurred: " . self::zipArchiveErrCodeToHumanMsg($res);
        }

        return false;
    }


    /**
     *
     * Returns the human message associated with the given zipArchive error code.
     *
     *
     * http://php.net/manual/en/ziparchive.open.php
     * last check: 2019-03-21
     *
     * @param int $errCode
     * @return string
     */
    private static function zipArchiveErrCodeToHumanMsg(int $errCode): string
    {

        switch ($errCode) {
            case \ZipArchive::ER_EXISTS:
                return "File already exists.";
                break;
            case \ZipArchive::ER_INCONS:
                return " Zip archive inconsistent.";
                break;
            case \ZipArchive::ER_INVAL:
                return "Invalid argument.";
                break;
            case \ZipArchive::ER_MEMORY:
                return "Mailoc failure.";
                break;
            case \ZipArchive::ER_NOENT:
                return "No such file.";
                break;
            case \ZipArchive::ER_NOZIP:
                return "Not a zip archive.";
                break;
            case \ZipArchive::ER_OPEN:
                return "Can't open file.";
                break;
            case \ZipArchive::ER_READ:
                return "Read error.";
                break;
            case \ZipArchive::ER_SEEK:
                return "Seek error.";
                break;
            default:
                return "Unknown error.";
                break;
        }
    }
}
