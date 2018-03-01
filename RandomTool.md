RandomTool
=====================
2018-02-27



This class contains functions for manipulating random functions.



getIp
------------
2018-02-27
     
     
```php     
str:ip     getIp()     
```     
     
Return a randomly generated ipv4 ip.





lorem
------------
2018-03-01
     
     
```php     
str     lorem( int:nbWords = null, int:minWords = 1, int:maxWords = 250 )     
```     
     
Return a randomly generated sentence made of "lorem" like words.

If $nbWords is not null, the sentence will contains exactly $nbWords words.

If null, then the sentence will contain between $minWords and $maxWords words.

Note: all words are lower case.

```php
az(RandomTool::lorem(null, 20,30)); // nec vitae mi fringilla mattis magna mauris ligula cras congue pretium ante sem praesent fermentum in molestie massa nibh nibh quam magna malesuada
```

