[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\XmlTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/XmlTool.md)


XmlTool::toArray
================



XmlTool::toArray — Return an array corresponding to the given xml structure, or false in case of syntax error.




Description
================


public static [XmlTool::toArray](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/XmlTool/toArray.md)(?$xml, $trimContent = true) : array | Ling\Bat\false, the array corresponding to the given xml structure




Return an array corresponding to the given xml structure, or false in case of syntax error.

The content of a node is what's BEFORE a node's children (if the node has children).
This means if you write some string in a node, but AFTER it's first child,
then the content will be empty.

In other words, in this first example the content is kebab:

<node>
kebab
<child></child>
</node>

While in this second example the content is empty:

<node>
<child></child>
kebab
</node>


The xml content must always encapsulate all nodes in a root node,
which name can be anything.
If your content has multiple root nodes, like the following:

<node1></node1>
<node2></node2>

Then only the first node, node1 in this case, will be parsed.




Parameters
================


- xml

    

- trimContent

    


Return values
================

Returns array | Ling\Bat\false, the array corresponding to the given xml structure.








See Also
================

The [XmlTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/XmlTool.md) class.



