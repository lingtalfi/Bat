FileTool
=====================
2016-12-23



This class contains functions for manipulating files.




cut
-------------
2017-04-04

```php
array    cut ( string:file, int:startLine, int:endLine )
```

Cut a file from line startLine to endLine, and returns an array containing two entries:
- 0: the part before the startLine
- 1: the part after the endLine



extract
-------------
2017-04-04

```php
string    extract ( string:file, array:slices )
```

extract the slices from the given file, and return the result as a string.

Each slice is an array:
 - 0: startLine of the part to cut
 - 1: endLine of the part to cut

Slices must not overlap.



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
     
     
