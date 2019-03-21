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
     */
    public static function unzip($zipFile, $target = null)
    {
        if (!extension_loaded('zip') || !file_exists($zipFile)) {
            return false;
        }

        if (null === $target) {
            // get the absolute path to $file
            $target = pathinfo(realpath($zipFile), PATHINFO_DIRNAME) . "/" . FileSystemTool::getFileName($zipFile);
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



//    /**
//     * Extract the archive as the given target directory.
//     *
//     * @param $archive
//     * @param $targetDir , if null, will be the archive name without the .zip extension
//     * @return bool, whether or not the archive could be extracted inside the target directory
//     * @throws \Exception when it doesn't know how to handle the case
//     */
//    public static function unzipOld($archive, $targetDir = null)
//    {
//        $unzip = exec('which unzip');
//        if ('' !== $unzip) {
//            $tmpDir = FileSystemTool::tempDir();
//            $cmd = 'unzip "' . str_replace('"', '\"', $archive) . '" -d"' . str_replace('"', '\"', $tmpDir) . '"';
//            $output = [];
//            $ret = false;
//            exec($cmd, $output, $ret);
//            if (0 === $ret) {
//                $files = scandir($tmpDir);
//                foreach ($files as $f) {
//                    if ('.' !== $f && '..' !== $f) {
//                        $dir = $tmpDir . "/" . $f;
//                        if (is_dir($dir)) {
//                            if (null === $targetDir) {
//                                $targetDirectory = dirname($archive);
//                                $name = pathinfo($archive, PATHINFO_FILENAME);
//                                $targetDir = $targetDirectory . "/" . $name;
//                            }
//                        }
//                        FileSystemTool::remove($targetDir);
//                        FileSystemTool::mkdir(dirname($targetDir), 0777, true);
//                        $ret = rename($dir, $targetDir);
//                        FileSystemTool::remove($tmpDir);
//                        return $ret;
//                    }
//                }
//            } else {
//                throw new \Exception("unzip command error: " . implode(PHP_EOL, $output));
//            }
//        } else {
//            // new handlers here...
//            throw new \Exception("Don't know how to handle the unzip on this machine yet");
//        }
//        return false;
//    }
//
}
