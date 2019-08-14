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





getRandomColor
------------
2018-03-27
     
     
```php     
str        getRandomColor()     
```     
     
Return a randomly generated hex color, with the hash symbol prefix.


```php
az(RandomTool::getRandomColor()); // #f1aa56
```



pickRandomFromArray
------------
2019-08-14
     
     
```php     
mixed        pickRandomFromArray( arr:array )     
```     
     
Returns a random element from the given array.


```php
$arr = ["one", "two", "three"];
a(RandomTool::pickRandomFromArray($arr)); // two
```




randomBool
------------
2019-08-14
     
     
```php     
bool        randomBool( int:probabilityOfTrue = 50 )     
```     
     
Returns a random boolean.

If the $probabilityOfTrue is given, it's the probability expressed in percentage (i.e. an int between 0 and 100)

that this method will return true (i.e. 100 will always return true, and 0 will always return false).


```php
az(RandomTool::randomBool()); // true
```

