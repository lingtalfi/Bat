ShortCodeTool
=====================
2019-07-03 -> 2020-07-27



This class contains functions for manipulating shortcodes.

Please consider using [SmartCodeTool](https://github.com/lingtalfi/NotationFan/blob/master/smart-code.md) instead,
which is more common in my work.





parse
-----------
2019-07-03


Parses a shortcode expression (which looks like the arguments in a php method call),
and return the corresponding array.

This method is actually just a proxy to the original ShortCodeTool::parse method from the Bee framework.

For more info about shortcode, please checkout the original documentation for the 
ShortCodeTool::parse method (https://github.com/lingtalfi/BeeFramework/blob/master/Notation/String/ShortCode/Tool/ShortCodeTool.php).
     

```php
array parse (str:expression)
```


### Example


The following: 
```php
az(ShortCodeTool::parse("hello=6, pou=[a, [b, c]], e='po=po', f='[pou]', g=[po => 4, go => [1,2,3], mo]"));
```


Will give an array like this:


```html
array(5) {

     ["hello"] => int(6)
     ["pou"] => array(2) {
         [0] => string(1) "a"
         [1] => array(2) {
             [0] => string(1) "b"
             [1] => string(1) "c"
         }
     }
     ["e"] => string(5) "po=po"
     ["f"] => string(5) "[pou]"
     ["g"] => array(3) {
         ["po"] => int(4)
         ["go"] => array(3) {
              [0] => int(1)
             [1] => int(2)
             [2] => int(3)
         }
         [0] => string(2) "mo"
     }
}
```
