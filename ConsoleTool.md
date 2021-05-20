ConsoleTool
=====================
2019-03-19 -> 2021-05-20



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




clearLine
-----------
2021-05-20


```php
void  clearLine ( )
```

Clears the current line. This needs to be called from a terminal.



cursorDown
-----------
2021-05-20


```php
void  cursorDown ( int:n = 1 )
```

Prints the ansi escape code to move the cursor down n times.


cursorLeft
-----------
2021-05-20


```php
void  cursorLeft ( int:n = 1 )
```

Prints the ansi escape code to move the cursor to the left n times.



cursorRight
-----------
2021-05-20


```php
void  cursorRight ( int:n = 1 )
```

Prints the ansi escape code to move the cursor to the right n times.


cursorUp
-----------
2021-05-20


```php
void  cursorUp ( int:n = 1 )
```

Prints the ansi escape code to move the cursor up n times.





exec
-----------
2019-03-19 -> 2020-12-16


```php
bool    exec ( str:cmd, array:&outputLines=[], int &return=0 )
```

Executes the given $cmd command, and returns whether it was successful.
The $outputLines variable will contain all lines (as an array) written on STD_OUT by the command.
The return variable contains the return status.



```php
<?php

ConsoleTool::exec("cp /tmp/test1.txt /tmp/test2.txt"); // true

```



getUserHomeDirectory
-----------
2020-06-01


```php
string|null    getUserHomeDirectory ( )
```

Returns the user home directory if found, or null otherwise.

Note: this should only works on mac and unix machines, not windows (like almost all my tools).


```php
<?php

ConsoleTool::getUserHomeDirectory(); // /Users/lingtalfi

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



reset
-----------
2020-12-03


```php
void    reset ( )
```

Invokes the reset command (assuming it exists), which in effect resets the terminal.


```php
<?php

ConsoleTool::reset();)

```


