ImageTool
=====================
2021-07-17 - 2021-07-18



This class contains functions to help with images.





getDimensions
---------
2021-07-18


```php
public static function getDimensions(string $imageFile): array
```


Returns the dimensions as an array of the given image file, based on the file extension.
The returned array contains two elements:

- 0: int, the width in pixels
- 1: int, the height in pixels



The file can be an url too.

This method assumes that the given image file is actually a real image.
If not, unpredictable results might be returned.