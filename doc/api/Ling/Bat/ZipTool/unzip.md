[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\ZipTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ZipTool.md)


ZipTool::unzip
================



ZipTool::unzip — Extract the given zip file as the given target directory.




Description
================


public static [ZipTool::unzip](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ZipTool/unzip.md)(?$zipFile, $target = null) : Ling\Bat\false if something went wrong (for instance if the zip extension is not loaded)




Extract the given zip file as the given target directory.
If target is null, then the zip will be extracted in a directory of the same name as the zip file but without the zip extension.

Examples
-------------

### If archive.zip file contains a directory containing two files:
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

### If archive.zip file contains a single file named a.txt:

Then:

- Bat::unzip( /my/archive.zip, /path/to/target )
results in:
- /path/to/target/a.txt

- Bat::unzip( /my/archive.zip )
results in:
- /my/archive/a.txt






Source: https://stackoverflow.com/questions/8889025/unzip-a-file-with-php




Parameters
================


- zipFile

    

- target

    


Return values
================

Returns Ling\Bat\false if something went wrong (for instance if the zip extension is not loaded).








See Also
================

The [ZipTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ZipTool.md) class.

Next method: [zip](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ZipTool/zip.md)<br>

