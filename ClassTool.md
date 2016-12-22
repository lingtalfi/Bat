ClassTool
=====================
2016-12-22



This class contains functions for helping with classes.



getMethodContent
-----------
2016-12-22



```php
str    getMethodContent ( string:class, string:method )
```

Gets the code of the given method, from the start line
to the end line (including the signature).

 
```php
$content = ClassTool::getMethodContent(LayoutBridge::class, 'displayLeftMenuBlocks');
a($content);
``` 




