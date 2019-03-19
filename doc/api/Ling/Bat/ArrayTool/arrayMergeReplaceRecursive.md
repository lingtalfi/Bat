[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\ArrayTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool.md)


ArrayTool::arrayMergeReplaceRecursive
================



ArrayTool::arrayMergeReplaceRecursive — appending numeric keys, and replacing existing associative keys.




Description
================


public static [ArrayTool::arrayMergeReplaceRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/arrayMergeReplaceRecursive.md)(array $arrays) : array




Merge the given arrays and return a resulting array,
appending numeric keys, and replacing existing associative keys.




The merging rules are basically the following:
- set the associative key only if it doesn't already exist
- if it's a numeric key, append it


Example:
-----------
Given array1:
array(1) {
["example"] => array(2) {
["fruits"] => array(2) {
[0] => string(5) "apple"
[1] => string(6) "banana"
}
["numbers"] => array(2) {
["one"] => int(1)
["two"] => int(2)
}
}
}


and array2:
array(1) {
["example"] => array(3) {
["fruits"] => array(1) {
[0] => string(6) "cherry"
}
["sports"] => array(2) {
[0] => string(4) "judo"
[1] => string(6) "karate"
}
["numbers"] => array(1) {
["two"] => int(222)
}
}
}


The result of Bat::arrayMergeReplaceRecursive([array1, array2]) gives:

array(1) {
["example"] => array(3) {
["fruits"] => array(3) {
[0] => string(5) "apple"
[1] => string(6) "banana"
[2] => string(6) "cherry"
}
["numbers"] => array(2) {
["one"] => int(1)
["two"] => int(222)
}
["sports"] => array(2) {
[0] => string(4) "judo"
[1] => string(6) "karate"
}
}
}




Parameters
================


- arrays

    


Return values
================

Returns array.








See Also
================

The [ArrayTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool.md) class.

Previous method: [arrayKeyExistAll](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/arrayKeyExistAll.md)<br>Next method: [arrayUniqueRecursive](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/ArrayTool/arrayUniqueRecursive.md)<br>

