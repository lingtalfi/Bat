[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)



The FileSystemTool class
================
2019-03-19 --> 2019-03-19






Introduction
============

The FileSystemTool class.
LingTalfi 2015-10-07



Class synopsis
==============


class <span class="pl-k">FileSystemTool</span>  {

- Methods
    - public static [cleanDirBubble](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/cleanDirBubble.md)(?$dir) : void
    - public static [clearDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/clearDir.md)(?$file, $throwEx = true, $abortIfSymlink = true) : void
    - public static [copyDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/copyDir.md)(?$src, ?$target, $preservePerms = false, &$errors = []) : void
    - public static [copyFile](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/copyFile.md)(?$src, ?$target) : void
    - public static [countFiles](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/countFiles.md)(?$dir) : int
    - public static [existsUnder](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/existsUnder.md)(?$file, ?$dir) : void
    - public static [filePerms](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/filePerms.md)(?$file, $unix = true) : void
    - public static [getFileExtension](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/getFileExtension.md)(?$file) : string
    - public static [getFileName](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/getFileName.md)(?$file) : void
    - public static [getFileSize](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/getFileSize.md)(?$file, $humanize = false) : void
    - public static [getRelativePath](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/getRelativePath.md)(string $absolutePath, string $rootDir) : void
    - public static [fileGenerator](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/fileGenerator.md)(?$file, $ignoreTrailingNewLines = true) : void
    - public static [mkdir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkdir.md)(?$pathName, $mode = 511, $recursive = true) : void
    - public static [mkdirDone](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkdirDone.md)(?$pathName, $mode = 511, $recursive = true) : bool
    - public static [mkfile](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkfile.md)(?$pathName, $data = , $dirMode = 511, $mode = 0) : Ling\Bat\bool,
    - public static [mkTmpFile](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkTmpFile.md)(string $content) : void
    - public static [move](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/move.md)(string $src, string $dst) : void
    - public static [moveToDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/moveToDir.md)(string $filePath, string $directory) : void
    - public static [noEscalating](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/noEscalating.md)(?$uri) : void
    - public static [remove](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/remove.md)(?$file, $throwEx = true) : void
    - public static [removeExtension](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/removeExtension.md)(string $file) : void
    - public static [rename](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/rename.md)(?$src, ?$dst) : void
    - public static [tempDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/tempDir.md)($dir = null, $prefix = null) : void
    - public static [touchDone](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/touchDone.md)(?$fileName) : void
    - private static [_oops](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/_oops.md)(?$m, $throwEx = true) : void
    - private static [_remove](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/_remove.md)(?$file, $throwEx = true) : void

}






Methods
==============

- [FileSystemTool::cleanDirBubble](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/cleanDirBubble.md) &ndash; Check if the given dir is empty (i.e.
- [FileSystemTool::clearDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/clearDir.md) &ndash; Ensures that a directory exist and is empty.
- [FileSystemTool::copyDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/copyDir.md) &ndash; Copies a directory to a given location.
- [FileSystemTool::copyFile](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/copyFile.md) &ndash; 
- [FileSystemTool::countFiles](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/countFiles.md) &ndash; Return the number of files/dirs/links of a given dir.
- [FileSystemTool::existsUnder](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/existsUnder.md) &ndash; 
- [FileSystemTool::filePerms](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/filePerms.md) &ndash; Gets file permissions.
- [FileSystemTool::getFileExtension](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/getFileExtension.md) &ndash; 
- [FileSystemTool::getFileName](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/getFileName.md) &ndash; The file name without the last extension.
- [FileSystemTool::getFileSize](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/getFileSize.md) &ndash; 
- [FileSystemTool::getRelativePath](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/getRelativePath.md) &ndash; 
- [FileSystemTool::fileGenerator](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/fileGenerator.md) &ndash; Returns a generator function, which can iterate over the lines of the given file.
- [FileSystemTool::mkdir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkdir.md) &ndash; Ensures that a directory exists.
- [FileSystemTool::mkdirDone](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkdirDone.md) &ndash; Ensures that a directory exists, or throws an exception if something wrong happens.
- [FileSystemTool::mkfile](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkfile.md) &ndash; Creates a file, and the intermediary directories if necessary.
- [FileSystemTool::mkTmpFile](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/mkTmpFile.md) &ndash; 
- [FileSystemTool::move](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/move.md) &ndash; 
- [FileSystemTool::moveToDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/moveToDir.md) &ndash; 
- [FileSystemTool::noEscalating](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/noEscalating.md) &ndash; 
- [FileSystemTool::remove](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/remove.md) &ndash; Removes an entry from the filesystem.
- [FileSystemTool::removeExtension](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/removeExtension.md) &ndash; Removes the file extension from the given $file and returns the result.
- [FileSystemTool::rename](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/rename.md) &ndash; 
- [FileSystemTool::tempDir](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/tempDir.md) &ndash; 
- [FileSystemTool::touchDone](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/touchDone.md) &ndash; and that the method throws an Exception if something goes wrong.
- [FileSystemTool::_oops](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/_oops.md) &ndash; 
- [FileSystemTool::_remove](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileSystemTool/_remove.md) &ndash; 





Location
=============
Ling\Bat\FileSystemTool


SeeAlso
==============
Previous class: [ExceptionTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ExceptionTool.md)<br>Next class: [FileTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/FileTool.md)<br>
