FileListTool
=====================
2021-01-07



This class contains functions for manipulating file lists.

A file list is simply a list of relative paths (of files).





getFileList
-------------
2021-01-07


```php
getFileList(string $dir, array $options = []): array
```

Returns the list of files in the given $dir.

Note: symlinks are not followed.

Available options are:
- ignore: array of dir/file base names to ignore
     For instance:
         - .DS_Store
         - .git






copyFileListToDir
-------------
2021-01-07


```php
copyFileListToDir(array $fileList, string $srcDir, string $dstDir)
```

Copies the files listed in the given file list from the $srcDir to the $dstDir.

