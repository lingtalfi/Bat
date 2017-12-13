MathTool
=====================
2017-09-11



This class contains functions for helping with various math problems.



combinationsOf
-----------
2017-09-11


```php
array        combinationsOf ( int:n, array:pool ) 
```


This method returns all possible combinations of n elements in the pool.


getPercentagesByKeyValue
-----------
2017-12-13


```php
array     getPercentagesByKeyValue ( array:pool ) 
```


This method transforms an array of key/value pairs (each value being a number)
to an array of value/percentage pair.

It also ensures that the sum is exactly 100.
