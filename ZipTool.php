<?php

namespace Bat;


class ZipTool
{


    /**
     * Extract the archive as the given target directory.
     *
     * @param $archive
     * @param $targetDir , if null, will be the archive name without the .zip extension
     * @return bool, whether or not the archive could be extracted inside the target directory
     * @throws \Exception when it doesn't know how to handle the case
     */
    public static function unzip($archive, $targetDir = null)
    {
        $unzip = exec('which unzip');
        if ('' !== $unzip) {
            $tmpDir = FileSystemTool::tempDir();
            $cmd = 'unzip "' . str_replace('"', '\"', $archive) . '" -d"' . str_replace('"', '\"', $tmpDir) . '"';
            $output = [];
            $ret = false;
            exec($cmd, $output, $ret);
            if (0 === $ret) {
                $files = scandir($tmpDir);
                foreach ($files as $f) {
                    if ('.' !== $f && '..' !== $f) {
                        $dir = $tmpDir . "/" . $f;
                        if (is_dir($dir)) {
                            if (null === $targetDir) {
                                $targetDirectory = dirname($archive);
                                $name = pathinfo($archive, PATHINFO_FILENAME);
                                $targetDir = $targetDirectory . "/" . $name;
                            }
                        }
                        FileSystemTool::remove($targetDir);
                        FileSystemTool::mkdir(dirname($targetDir), 0777, true);
                        $ret = rename($dir, $targetDir);
                        FileSystemTool::remove($tmpDir);
                        return $ret;
                    }
                }
            } else {
                throw new \Exception("unzip command error: " . implode(PHP_EOL, $output));
            }
        } else {
            // new handlers here...
            throw new \Exception("Don't know how to handle the unzip on this machine yet");
        }
        return false;
    }

}
