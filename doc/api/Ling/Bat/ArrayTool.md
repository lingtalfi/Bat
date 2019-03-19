[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)



The ArrayTool class
================
2019-03-19 --> 2019-03-19






Introduction
============

The ArrayTool class.
LingTalfi 2015-12-20



Class synopsis
==============


class <span class="pl-k">ArrayTool</span>  {

- Methods
    - public static [arrayKeyExistAll](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/arrayKeyExistAll.md)(array $keys, array $pool) : void
    - public static [arrayMergeReplaceRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/arrayMergeReplaceRecursive.md)(array $arrays) : array
    - public static [arrayUniqueRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/arrayUniqueRecursive.md)(array $array) : void
    - public static [getMissingKeys](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/getMissingKeys.md)(array $arr, array $keys) : array | false
    - public static [keysSameAsValues](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/keysSameAsValues.md)(array $values) : array
    - public static [mirrorRange](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/mirrorRange.md)(?$start, ?$end, $step = 1) : array
    - public static [removeEntry](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/removeEntry.md)(?$entry, array &$arr) : void
    - public static [insertRowAfter](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/insertRowAfter.md)(int $index, array $row, array &$rows) : void
    - public static [superimpose](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/superimpose.md)(array $layer, array $base) : array
    - public static [updateNodeRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/updateNodeRecursive.md)(array &$arr, callable $callback, array $options = []) : void

}






Methods
==============

- [ArrayTool::arrayKeyExistAll](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/arrayKeyExistAll.md) &ndash; 
- [ArrayTool::arrayMergeReplaceRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/arrayMergeReplaceRecursive.md) &ndash; appending numeric keys, and replacing existing associative keys.
- [ArrayTool::arrayUniqueRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/arrayUniqueRecursive.md) &ndash; 
- [ArrayTool::getMissingKeys](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/getMissingKeys.md) &ndash; Check that all given $keys exist (as keys) in the given $arr.
- [ArrayTool::keysSameAsValues](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/keysSameAsValues.md) &ndash; Return an array with keys equal to values.
- [ArrayTool::mirrorRange](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/mirrorRange.md) &ndash; (i.e.
- [ArrayTool::removeEntry](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/removeEntry.md) &ndash; 
- [ArrayTool::insertRowAfter](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/insertRowAfter.md) &ndash; 
- [ArrayTool::superimpose](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/superimpose.md) &ndash; the <layer> (only if the key match).
- [ArrayTool::updateNodeRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/updateNodeRecursive.md) &ndash; 





Location
=============
Ling\Bat\ArrayTool


SeeAlso
==============
Next class: [BDotTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/BDotTool.md)<br>
