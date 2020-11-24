HepTool
=====================
2019-09-23 -> 2020-11-24



This class contains methods for manipulating [Hep parameters](https://github.com/lingtalfi/NotationFan/blob/master/html-element-parameters.md).




hepAttributes
-------------
2019-09-23 -> 2020-11-24



```php
str    hepAttributes ( array:params, str:prefix=null )
```

Returns the (html) string corresponding to the hep attributes.


### Example

The following code:

```php
az(HepTool::hepAttributes(["a" => "apple", "b-ikini" => "banana", "cCaseC_CC" => "cherry"]));
```

Will produce this output:

```html

string(79) " data-param-a="apple" data-param-b-ikini="banana" data-param-cCaseC_CC="cherry""

```


