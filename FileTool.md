FileTool
=====================
2016-12-23



This class contains functions for manipulating files.




cleanVerticalSpaces
-------------
2017-04-20

```php
array    cleanVerticalSpaces ( string:file, int:maxConsecutiveBlankLines=3 )
```

Replace more than n consecutive blank lines by n consecutive blank lines.





cut
-------------
2017-04-04

```php
array    cut ( string:file, int:startLine, int:endLine, bool:replaceFile=false )
```

Cut a file from line startLine to endLine, and returns an array containing two entries:
- 0: the part before the startLine
- 1: the part after the endLine

If replaceFile is true, also replace the actual file (doing the cut).



extract
-------------
2017-04-04 --> 2017-04-20

```php
string    extract ( string:file, array:slices )
```

extract the slices from the given file, and return the result as a string. 
It will also save the file with the actual changes done, if replaceFile is true.

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
     
     

insert
-------------
2017-04-20
     
```php     
void  insert ( int:lineNumber, str:content, str:file )
```     

Inserts the given content at the given lineNumber for the file.
If the given lineNumber is greater than the number of lines in the file,
the content will be appended to the existing file, prefixed with a newline.





split
-------------
2017-03-24

```php
array    split ( string:file, int:lineNumber )
```

Split a file in two parts, at the given lineNumber , and return the two parts.

The line indicated by lineNumber is part of the second half (not the first half).
     
     
