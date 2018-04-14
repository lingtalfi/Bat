ObTool
=====================
2017-04-04



This class contains functions for manipulating ob buffer.





    
cleanAll
-------------
2017-04-04


```php
null|string    cleanAll ( bool:returnContent:false )
```

cleans all levels of buffers


### Example

```php
<?php

ObTool::cleanAll();



```



writeWithoutBuffering
-------------
2018-04-14


```php
void writeWithoutBuffering ( callable:printFunction )
```

executes the printFunction in "no buffer" mode (i.e. the output of the function gets displayed "live" in the browser,
meaning the buffer gets flushed as the function prints something using echo).


### Example

```php
<?php

ObTool::writeWithoutBuffering( function(){
    for($i = 1; $i <= 10000; $i++){
        echo "php rocks<br>";
    }
});


```


