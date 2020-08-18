CommentTool
=====================
2020-08-18



This class contains functions related to php comments.



comment
-----------
2020-08-18


```php
public static function comment(string $string, string $type = 'single'): string
```


Comments the given string and returns the result.

We can choose the type of comments being used with the type argument, which can be one of:

- single: starting with //
- doc:    starting with /**


Examples to play with in a browser:



```php
<?php
header("Content-type: text/plain");
$string = <<<EEE
    public static function testPower(string \$string): string
    {
        echo "power";
    }
EEE;
echo CommentTool::comment($string);
```

Will display:

```html
//     public static function testPower(string $string): string
//     {
//         echo "power";
//     }
```




```php
<?php
header("Content-type: text/plain");
$string = <<<EEE
    public static function testPower(string \$string): string
    {
        echo "power";
    }
EEE;
echo CommentTool::comment($string, 'doc');

```

Will display:

```html
/**     public static function testPower(string $string): string
*     {
*         echo "power";
*     }
*/
```
