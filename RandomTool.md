RandomTool
=====================
2018-02-27 -> 2020-03-10



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


pickRandomFile
------------
2018-08-14
     
     
```php     
str        pickRandomFile( str:dir, mixed:extension=null, bool:recursive=false )     
```     
     
Picks a random file from the given $dir and returns its path.
If extension is provided, it can be either a string or an array of extensions (without the leading dot),
and defines which extension(s) to look for.

By default, this method doesn't look into subdirectories, but we can change this with the recursive flag
set to true.     



```php
$dir = "/mysite/www/plugins/Light_Kit_Admin/img/avatars";
a(RandomTool::pickRandomFile($dir)); // string(117) "/mysite/www/plugins/Light_Kit_Admin/img/avatars/user_avatar.png"
```



pickRandomFromArray
------------
2019-08-14
     
     
```php     
mixed        pickRandomFromArray( arr:array, int:nbRequests=null, bool:pickOnce=true )     
```     
     
Returns a random element from the given array,
or multiple randomly chosen elements if the $nbRequests parameter is provided.

By default, an element can be picked only once.
But we can set the pickOnce flag to false to allow the same item to picked up multiple times.


### Example

The following code: 

```php
$arr = ["one", "two", "three"];

a(RandomTool::pickRandomFromArray($arr));
a(RandomTool::pickRandomFromArray($arr, 2));
a(RandomTool::pickRandomFromArray($arr, 5));
a(RandomTool::pickRandomFromArray($arr, 5, false));

```


This will output something like this:

```html
string(3) "two"

array(2) {
  [0] => string(5) "three"
  [1] => string(3) "one"
}

array(3) {
  [0] => string(3) "one"
  [1] => string(5) "three"
  [2] => string(3) "two"
}

array(5) {
  [0] => string(3) "two"
  [1] => string(5) "three"
  [2] => string(5) "three"
  [3] => string(3) "one"
  [4] => string(3) "one"
}
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



randomDate
------------
2020-03-10
     
     
```php     
string        randomDate( )     
```     
     
Returns a random date in the mysql format (yyyy-mm-dd).


```php
az(RandomTool::randomDate()); 
```

randomDatetime
------------
2020-03-10
     
     
```php     
string        randomDatetime( )     
```     
     
Returns a random datetime in the mysql format (yyyy-mm-dd hh-ii-ss).


```php
az(RandomTool::randomDatetime()); 
```



randomString
------------
2020-03-10
     
     
```php     
string        randomString( int:length=null )     
```     
     
Returns a random string.


```php
a(RandomTool::randomString(10)); // d45g0rZLKG 
```



