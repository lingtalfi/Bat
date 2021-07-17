ImageTool
=====================
2021-07-17



This class contains functions to help with images.




getCountryAlpha3CodeByAlpha2Code
-------------
2017-10-28



```php
public static function getDimensions(string $imageFile): array
```

Returns the dimensions (w, h) of the given image file, based on the file extension.

The file can be an url too.

This method assumes that the given image file is actually a real image.
If not, unpredictable results might be returned.



Example:

```php 
$f = "/kit_store/www/libs/universe/Ling/Light_Kit_Store/img/products/76/large/amazon-4.jpg";
az(ImageTool::getDimensions($f)); 

```

Will output something like this:

```html 
array(2) {
  ["width"] => int(1500)
  ["height"] => int(1500)
}

```