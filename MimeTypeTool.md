MimeTypeTool
=====================
2015-10-25 -> 2020-04-07



This class contains functions for handling mime type.



getMimeType
-----------
2015-10-25


```php
string        getMimeType ( string:file ) 
```


This method returns the mime type associated with the given file.


getMimeTypeByFileExtension
-----------
2019-10-17


```php
string        getMimeTypeByFileExtension ( string:extension, string default=null, bool &found=true) 
```


Returns the mime type associated with the given file extension, or returns the given default extension otherwise.
if the default extension is not provided, it defaults to "application/octet-stream".

If the extension has no corresponding mime-type, the found flag is set to false.
This is a mechanism to help the developer be aware of that miss and potentially keep this method updated.



isMimeImage
-----------
2020-04-07


```php
bool        isMimeImage ( string:mime) 
```


Returns whether the given mime type is an image or not.


Example

```php
a(MimeTypeTool::isMimeImage("image/png")); // true
a(MimeTypeTool::isMimeImage("application/octet-stream")); // false
```