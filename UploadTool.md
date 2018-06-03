UploadTool
=====================
2017-08-20



This class contains functions for helping with php file uploads.




Note: 
some examples require a bigbang script and use the **a** function. More on this here in the [bigbang technique]( https://github.com/lingtalfi/TheScientist/blob/master/convention.portableAutoloader.eng.md ).





getPhpFilesArrayFromCombinedStructure
-----------
2018-06-03


```php
array getPhpFilesArrayFromCombinedStructure ( arr:combinedStructure )
```

Return an array of phpFileModel from the given combinedStructure.


With phpFileModel: array:
- name
- tmp_name
- error
- type
- size


and combinedStructure: array:
- name: array of php file names
- type: array of php file mime types
- tmp_name: array of php file temporary locations
- error: array of php file error indicators
- size: array of php file sizes



getPhpFilesArrayFromFilesSuperArrayItem
-----------
2018-06-03


```php
array getPhpFilesArrayFromFilesSuperArrayItem ( arr:phpFileItem )
```

Return an array of phpFileModel from the given phpFileItem.


With phpFileModel: see getPhpFilesArrayFromCombinedStructure.
phpFileItem, a regular entry from the $_FILES super array.


```php
a(UploadTool::getPhpFilesArrayFromFilesSuperArrayItem($_FILES['files']));
```







isValid
-----------
2017-08-20


```php
bool isValid( arr:phpFile )
```

Check that the phpFile array is valid and contains no error.
If that's not the case, return false.



