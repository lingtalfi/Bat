[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\ZipTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ZipTool.md)


ZipTool::zip
================



ZipTool::zip — Creates a zip file from the given source.




Description
================


public static [ZipTool::zip](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ZipTool/zip.md)(?$source, ?$zipFileName) : Ling\Bat\false if something went wrong (extension zip not loaded for instance)




Creates a zip file from the given source.
Source can be either a simple file or a directory (in which case all it will be added recursively to the zip file).
Note: this method creates the necessary subdirectories for the zip file if necessary.



Source:
https://stackoverflow.com/questions/1334613/how-to-recursively-zip-a-directory-in-php




Parameters
================


- source

    

- zipFileName

    


Return values
================

Returns Ling\Bat\false if something went wrong (extension zip not loaded for instance).








See Also
================

The [ZipTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ZipTool.md) class.

Previous method: [unzip](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ZipTool/unzip.md)<br>

