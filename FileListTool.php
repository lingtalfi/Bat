<?php


namespace Ling\Bat;


use Ling\DirScanner\YorgDirScannerTool;


/**
 * The FileListTool class.
 *
 * Concepts used in this class:
 *
 * - filelist: an array of relative paths pointing to files, symlinks (to files or dirs), and optionally dirs.
 *
 *
 *
 */
class FileListTool
{

    /**
     * Returns the list of files in the given $dir.
     *
     * Note: symlinks are not followed, but they are collected
     *
     * Available options are:
     * - ignore: array of dir/file base names to ignore
     *      For instance:
     *          - .DS_Store
     *          - .git
     *
     *
     *
     * @param string $dir
     * @param array $options
     * @return array
     */
    public static function getFileList(string $dir, array $options = []): array
    {
        $ignore = $options['ignore'] ?? [];
        return YorgDirScannerTool::getFilesIgnore($dir, $ignore, true, true, false, 1, true);
    }


    /**
     * Copies the files listed in the given file list from the $srcDir to the $dstDir.
     * If the entry is a dir, the dir will be copied recursively.
     *
     * @param array $fileList
     * @param string $srcDir
     * @param string $dstDir
     */
    public static function copyFileListToDir(array $fileList, string $srcDir, string $dstDir)
    {

        foreach ($fileList as $relPath) {
            $srcAbsPath = $srcDir . "/" . $relPath;
            $dstAbsPath = $dstDir . "/" . $relPath;

            // if it's a link, we preserve it as is
            if (true === is_link($srcAbsPath)) {
                $linkDst = readlink($srcAbsPath);

                FileSystemTool::remove($dstAbsPath);

                $dstAbsDir = dirname($dstAbsPath);
                FileSystemTool::mkdir($dstAbsDir);
                symlink($linkDst, $dstAbsPath);

            } else {
                if (true === is_file($srcAbsPath)) {
                    FileSystemTool::copyFile($srcAbsPath, $dstAbsPath);
                } elseif (true === is_dir($srcAbsPath)) {
                    FileSystemTool::copyDir($srcAbsPath, $dstAbsPath);
                }
            }
        }
    }
}