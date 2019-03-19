[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\ArrayTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool.md)


ArrayTool::updateNodeRecursive
================



ArrayTool::updateNodeRecursive — 




Description
================


public static [ArrayTool::updateNodeRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/updateNodeRecursive.md)(array &$arr, callable $callback, array $options = []) : void









Parameters
================


- arr

    

- callback

    

- options

    Example:
(this will add the link property to every node in the array recursively)


$linkFmt = "/mylink/{type}/{slug}";
ArrayTool::updateNodeRecursive($ret, function (array &$row) use ($linkFmt) {
$row['link'] = str_replace([
"{type}",
"{slug}",
], [
$row['type'],
$row['slug'],
], $linkFmt);
});


Return values
================

Returns void.








See Also
================

The [ArrayTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool.md) class.

Previous method: [superimpose](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/superimpose.md)<br>

