ConsoleTool
=====================
2019-03-19



This class contains functions for console related tasks.



capture
-----------
2019-03-19


```php
string    capture ( str:cmd, int &return=0 )
```

Executes the given $cmd command, and returns the captured output (what was written on STD_OUT).
The $return variable will contain the return code of the command. It will be integer 0 if the command
was successful.


```php
<?php

ConsoleTool::capture("whoami"); // ling

```




exec
-----------
2019-03-19


```php
bool    exec ( str:cmd, array:&outputLines=[] )
```

Executes the given $cmd command, and returns whether it was successful.
The $outputLines variable will contain all lines (as an array) written on STD_OUT by the command.


```php
<?php

ConsoleTool::exec("cp /tmp/test1.txt /tmp/test2.txt"); // true

```





passThru
-----------
2019-03-21


```php
bool    passthru ( str:cmd )
```

Executes the php passthru function, and returns whether the command was successful.


```php
<?php

ConsoleTool::passThru("cp /tmp/test1.txt /tmp/test2.txt"); // true

```


