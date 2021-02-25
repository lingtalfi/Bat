ZipTool
=====================
2016-12-29 -> 2021-02-25

Zip related tool.



addToZip
-----------
2021-02-25

```php
void    addToZip ( str:zipFile, str:srcPath, str:dstName )
```

Adds an entry to an existing zip file.

The sourcePath can be a directory or a file. If it's a directory, its content will be added recursively.

The dest name is the relative path inside the zip.

### Example

```php 

$f = "/tmp/light-app-boilerplate.zip";
$srcPath = "/tmp/test/config";
$dstName = "config";
ZipTool::addToZip($f, $srcPath, $dstName);

```

deleteFromZip
-----------
2021-02-25

```php
void    addToZip ( str:zipFile, str:name, bool:isDir )
```

Removes an entry from an existing zip file.

The name is the relative path of the entry to remove (relative to the zip's root).






unzip
-----------
2016-12-29 --> 2019-01-19

```php
bool    unzip ( str:archive, str:targetDir=null )
```

Extract the given zip file as the given target directory, and returns whether the operation was successful. If target is
null, then the zip will be extracted in a directory of the same name as the zip file but without the zip extension.
Returns false if something went wrong (for instance if the zip extension is not loaded).

### Examples

#### If archive.zip file contains a directory containing two files:

     - a.txt
     - b.txt

Then:

- Bat::unzip( /my/archive.zip, /path/to/target )
  results in:
  - /path/to/target/a.txt - /path/to/target/b.txt

- Bat::unzip( /my/archive.zip )
  results in:
  - /my/archive/a.txt - /my/archive/b.txt

#### If archive.zip file contains a single file named a.txt:

Then:

- Bat::unzip( /my/archive.zip, /path/to/target )
  results in:
  - /path/to/target/a.txt

- Bat::unzip( /my/archive.zip )
  results in:
  - /my/archive/a.txt

```php
$archive = 'bashmanager.zip';             
$targetDir = "bashmanager";               
$targetDir = null;                        
az(ZipTool::unzip($archive, $targetDir));
``` 

zip
---
2019-01-16

```php
bool    zip ( str:source, str:zipFileName, array:options )
```

Creates a zip file from the given source, and returns whether the operation was successful. Source can be either a
simple file or a directory (in which case all it will be added recursively to the zip file). Note: this method creates
the necessary subdirectories for the zip file if necessary. Returns false if something went wrong (extension zip not
loaded for instance).

If the zip file already exists, it will be overwritten.

Options:

- ignoreHidden: bool=false. Whether to ignore files/dirs which name starts with a dot (.), provided that the given
  source is a directory.
- ignoreName: array=[]. An array of file/directory names to ignore (provided that the given source is a directory). If a
  directory matches, the entire directory and its content will be ignored recursively.
- ignorePath: array=[]. An array of file/directory relative paths to ignore (provided that the given source is a
  directory). If a directory matches, the entire directory and its content will be ignored recursively. Note: a relative
  path doesn't start with a slash.

```php
ZipTool::zip(__DIR__ . "/my_dir", "my_dir.zip");
```

zipByPaths
---
2019-03-21

```php
bool    zipByPaths ( str:dstZipFile, str:rootDir, array:relativePaths, array:&errors=[], array:&failed=[] )
```

Creates a zip archive based on the given relative paths, and returns whether the operation was a success.

If the zip file already exists, it will be overwritten.

### Parameters

- dstZipFile: The name (path) of the zip file to create.
- rootDir: The root dir, base of all relative paths.
- $relativePaths: An array of relative paths (relative to the given $rootDir) to include in the archive. If the relative
  path is a directory, the directory will be included in the archive with its content (recursively).
- errors: An array of errors that might occur.
- failed: An array of file relative paths which transfer to the archive failed.

```php
$base = "/komin/jin_site_demo/class";
$files = [
    "dir1",
    "dir2/.htaccess",
    "Maurice.php",
];

$zipDst = "/tmp/myzip.zip";
$errors = [];
$failed = [];
a(ZipTool::zipByPaths($zipDst, $base, $files, $errors, $failed));
a($errors);
a($failed);


```
