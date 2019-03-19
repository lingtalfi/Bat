[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)



The UploadTool class
================
2019-03-19 --> 2019-03-19






Introduction
============

MODELS
===================

phpFile
---------------
array:
- name
- tmp_name
- error
- type
- size


combinedStructure
-------------------
array:
- name: array of php file names
- type: array of php file mime types
- tmp_name: array of php file temporary locations
- error: array of php file error indicators
- size: array of php file sizes



Class synopsis
==============


class <span class="pl-k">UploadTool</span>  {

- Methods
    - public static [isValid](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/UploadTool/isValid.md)(array $phpFile) : bool
    - public static [getPhpFilesArrayFromCombinedStructure](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/UploadTool/getPhpFilesArrayFromCombinedStructure.md)(array $combineStructure) : Ling\Bat\array of phpFile (see top of this class for more info)
    - public static [getPhpFilesArrayFromFilesSuperArrayItem](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/UploadTool/getPhpFilesArrayFromFilesSuperArrayItem.md)(array $phpFilesItem) : array | Ling\Bat\false an array of phpFile items (as described at the top of this class)

}






Methods
==============

- [UploadTool::isValid](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/UploadTool/isValid.md) &ndash; 
- [UploadTool::getPhpFilesArrayFromCombinedStructure](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/UploadTool/getPhpFilesArrayFromCombinedStructure.md) &ndash; 
- [UploadTool::getPhpFilesArrayFromFilesSuperArrayItem](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/UploadTool/getPhpFilesArrayFromFilesSuperArrayItem.md) &ndash; 





Location
=============
Ling\Bat\UploadTool


SeeAlso
==============
Previous class: [StringTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool.md)<br>Next class: [UriTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/UriTool.md)<br>
