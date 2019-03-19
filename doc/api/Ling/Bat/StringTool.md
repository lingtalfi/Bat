[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)



The StringTool class
================
2019-03-19 --> 2019-03-19






Introduction
============

The StringTool class.
LingTalfi 2015-10-14



Class synopsis
==============


class <span class="pl-k">StringTool</span>  {

- Properties
    - private static  [$irregular](#property-irregular) = ['woman' => 'women','man' => 'men','child' => 'children','tooth' => 'teeth','foot' => 'feet','person' => 'people','leaf' => 'leaves','mouse' => 'mice','goose' => 'geese','half' => 'halves','knife' => 'knives','wife' => 'wives','life' => 'lives','elf' => 'elves','loaf' => 'loaves','potato' => 'potatoes','tomato' => 'tomatoes','cactus' => 'cacti','focus' => 'foci','fungus' => 'fungi','nucleus' => 'nuclei','syllabus' => 'syllabi','analysis' => 'analyses','diagnosis' => 'diagnoses','oasis' => 'oases','thesis' => 'theses','crisis' => 'crises','phenomenon' => 'phenomena','criterion' => 'criteria','datum' => 'data'] ;

- Methods
    - public static [autoCast](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/autoCast.md)(?$string) : void
    - public static [camelCase2Constant](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/camelCase2Constant.md)(?$str) : void
    - public static [cutNumericalSuffix](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/cutNumericalSuffix.md)(?$str) : void
    - public static [htmlAttributes](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/htmlAttributes.md)(array $attributes, $keyPrefix = ) : void
    - public static [getPlural](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/getPlural.md)(?$word) : void
    - public static [getUniqueCssId](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/getUniqueCssId.md)($prefix = a) : void
    - public static [indent](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/indent.md)(string $string, int $indentNumber) : string
    - public static [relativePath](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/relativePath.md)(?$absoluteBaseDir, ?$absolutePath, $default = null) : string | Ling\Bat\mixed, a relative path, starting with a slash (at least on linux,
    - public static [removeAccents](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/removeAccents.md)(?$str) : void
    - public static [replacePortion](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/replacePortion.md)(?$string, ?$start, ?$length, ?$replacement) : string
    - public static [split](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/split.md)(?$string) : void
    - public static [strPosAll](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/strPosAll.md)(?$haystack, ?$needle, $offset = 0) : void
    - public static [ucfirst](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/ucfirst.md)(?$string) : void
    - public static [unserializeAsArray](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/unserializeAsArray.md)(?$string) : array | mixed

}




Properties
=============

- <span id="property-irregular"><b>irregular</b></span>

    
    
    



Methods
==============

- [StringTool::autoCast](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/autoCast.md) &ndash; 
- [StringTool::camelCase2Constant](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/camelCase2Constant.md) &ndash; 
- [StringTool::cutNumericalSuffix](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/cutNumericalSuffix.md) &ndash; 
- [StringTool::htmlAttributes](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/htmlAttributes.md) &ndash; Returns an html attributes string based on the given array.
- [StringTool::getPlural](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/getPlural.md) &ndash; 
- [StringTool::getUniqueCssId](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/getUniqueCssId.md) &ndash; 
- [StringTool::indent](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/indent.md) &ndash; Returns the given $string, but indented with the $indentNumber spaces for every line.
- [StringTool::relativePath](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/relativePath.md) &ndash; Drop the absoluteBaseDir string in front of the absolutePath.
- [StringTool::removeAccents](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/removeAccents.md) &ndash; 
- [StringTool::replacePortion](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/replacePortion.md) &ndash; Cuts a portion of a string, and replaces it with a replacement string.
- [StringTool::split](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/split.md) &ndash; Split the given (assumed) string into an array of multi-byte characters.
- [StringTool::strPosAll](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/strPosAll.md) &ndash; Returns an array containing all the positions of $needle in $haystack.
- [StringTool::ucfirst](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/ucfirst.md) &ndash; 
- [StringTool::unserializeAsArray](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/StringTool/unserializeAsArray.md) &ndash; 





Location
=============
Ling\Bat\StringTool


SeeAlso
==============
Previous class: [SessionTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/SessionTool.md)<br>Next class: [UploadTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/UploadTool.md)<br>
