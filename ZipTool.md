ZipTool
=====================
2016-12-29



Zip related tool.



unzip
-----------
2016-12-29 --> 2019-01-19


```php
bool    unzip ( str:archive, str:targetDir=null )
```

Extract the given zip file as the given target directory, and returns whether the operation was successful.
If target is null, then the zip will be extracted in a directory of the same name as the zip file but without the zip extension.
Returns false if something went wrong (for instance if the zip extension is not loaded).

### Examples


#### If archive.zip file contains a directory containing two files:
     - a.txt
     - b.txt

Then:

- Bat::unzip( /my/archive.zip, /path/to/target )
     results in:
             - /path/to/target/a.txt
             - /path/to/target/b.txt

- Bat::unzip( /my/archive.zip )
     results in:
             - /my/archive/a.txt
             - /my/archive/b.txt

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
bool    zip ( str:source, str:zipFileName )
```

Creates a zip file from the given source, and returns whether the operation was successful.
Source can be either a simple file or a directory (in which case all it will be added recursively to the zip file).
Note: this method creates the necessary subdirectories for the zip file if necessary.
Returns false if something went wrong (extension zip not loaded for instance).


```php
ZipTool::zip(__DIR__ . "/my_dir", "my_dir.zip");
```
