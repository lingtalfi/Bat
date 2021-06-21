TemplateTool
=====================
2021-06-21



This class contains functions for manipulating templates.



copy
-------------
2021-06-21


```php
public static function copy(string $srcFile, string $dstFile, array $replacements = []): void
```

Copies the source file to the destination, and replace the given variables by their values.

The replacements array is an array of key/value pairs.

The destination is always overwritten if it exists.

Note: the replacements are done the same way as the php str_replace function (i.e. order matters).