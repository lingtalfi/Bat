ConvertTool
=====================
2018-06-03



This class contains functions for conversion related tasks.



convertBytes
-----------
2018-06-03


```php
float    convertBytes ( int:bytes, string:destUnit=b, precision=2 )
```

Convert a bytes number to another unit.



```php
<?php


$sizeInMegaBytes = ConvertTool::convertBytes(566000000, "mb");
az($sizeInMegaBytes); // float(539.78)


```



convertHumanSizeToBytes
-----------
2018-06-03


```php
int    convertHumanSizeToBytes ( string:humanSize )
```

Convert a human size to a number of bytes.



```php
<?php


$sizeInBytes = ConvertTool::convertHumanSizeToBytes( "5M");
az($sizeInBytes); // int(5242880)


```
