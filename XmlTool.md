XmlTool
=====================
2017-06-27



This class contains functions for manipulating xml.



toArray
-----------
2017-06-27

Return the array version of the given xml structure.


The content of a node is what's BEFORE a node's children (if the node has children).

This means if you write some string in a node, but AFTER it's first child,
then the content will be empty.

In other words, in this first example the content is kebab:

```xml
<node>
     kebab
     <child></child>
</node>
```

While in this second example the content is empty:

```xml
<node>
     <child></child>
     kebab
</node>
```


The xml content must always encapsulate all nodes in a root node,
which name can be anything.

If your content has multiple root nodes, like the following:

```txt
<node1></node1>
<node2></node2>
```


Then only the first node, node1 in this case, will be parsed (node2 will be ignored).


```php
array    toArray ( string:xml, bool:trimContent=true )
```

Example:


```php
<?php


$file = __DIR__ . "/xmlsample.xml";
az(XmlTool::toArray(file_get_contents($file)));

```
 
 
The **xmlsample.xml** file contains the following:
 
```xml
<root>
    <ncresponse orderID="" PAYID="0" NCERROR="50001111" STATUS="0"></ncresponse>
    <doritos>
        Kebab
        <fruit type="melon">

        </fruit>
    </doritos>
    <ncresponse orderID="" PAYID="0" NCERROR="50001111" STATUS="0"></ncresponse>
</root>
``` 


And the resulting array is the following:

```txt
array(4) {
  ["name"] => string(4) "root"
  ["attributes"] => array(0) {
  }
  ["content"] => string(0) ""
  ["children"] => array(3) {
    [0] => array(4) {
      ["name"] => string(10) "ncresponse"
      ["attributes"] => array(4) {
        ["orderID"] => string(0) ""
        ["PAYID"] => string(1) "0"
        ["NCERROR"] => string(8) "50001111"
        ["STATUS"] => string(1) "0"
      }
      ["content"] => string(0) ""
      ["children"] => array(0) {
      }
    }
    [1] => array(4) {
      ["name"] => string(7) "doritos"
      ["attributes"] => array(0) {
      }
      ["content"] => string(5) "Kebab"
      ["children"] => array(1) {
        [0] => array(4) {
          ["name"] => string(5) "fruit"
          ["attributes"] => array(1) {
            ["type"] => string(5) "melon"
          }
          ["content"] => string(0) ""
          ["children"] => array(0) {
          }
        }
      }
    }
    [2] => array(4) {
      ["name"] => string(10) "ncresponse"
      ["attributes"] => array(4) {
        ["orderID"] => string(0) ""
        ["PAYID"] => string(1) "0"
        ["NCERROR"] => string(8) "50001111"
        ["STATUS"] => string(1) "0"
      }
      ["content"] => string(0) ""
      ["children"] => array(0) {
      }
    }
  }
}

```
