ZipTool
=====================
2016-12-29



Zip related tool.



unzip
-----------
2016-12-29


```php
bool    unzip ( str:archive, str:targetDir=null )
```

Extract the archive as the given target directory.

If targetDir is null, it will be the archive name without the .zip extension.

Returns whether or not the archive could be extracted inside the target directory.

Exception are thrown when it doesn't know how to handle the case.


```php
$archive = 'bashmanager.zip';             
$targetDir = "bashmanager";               
$targetDir = null;                        
az(ZipTool::unzip($archive, $targetDir)); // true 
``` 





