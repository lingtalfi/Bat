FileTool
=====================
2016-12-23



This class contains functions for manipulating files.




getNbLines
-------------
2016-12-23

```php
int    getNbLines ( string:file )
```

Count the number of lines of the given file.
     
     

split
-------------
2017-03-24

```php
array    split ( string:file, int:lineNumber )
```

Split a file in two parts, at the given lineNumber , and return the two parts.

The line indicated by lineNumber is part of the second half (not the first half).
     
     
