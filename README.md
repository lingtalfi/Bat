Bat
==========
2015-10-07 --> 2020-04-13



[![Basic Tools](http://lingtalfi.com/img/universe/Bat/bat.png)](http://lingtalfi.com/img/universe/Bat/bat.png)



Bat (Basic Tools) is an ensemble of basic tools that one can use to 
hopefully do a job faster (from the coding point of view, not performance).

A tool is a **static class**, which means that you can call its methods
without having to instantiate it.


Bat is part of the [universe framework](https://github.com/karayabin/universe-snapshot).




Install
=============


Using the [uni tool](https://github.com/lingtalfi/universe-naive-importer)
```bash
uni import Ling/Bat
```






So far, the Bat library is composed of the following tools:



Tools       |       Description
----------- | -----------------------
[ArrayTool]( https://github.com/lingtalfi/Bat/blob/master/ArrayTool.md )          |       Tools for manipulating arrays
[BDotTool]( https://github.com/lingtalfi/Bat/blob/master/BDotTool.md )          |       Tools for using bdot notation
[CaseTool]( https://github.com/lingtalfi/Bat/blob/master/CaseTool.md )          |       Tools for converting a case to another
[ClassTool]( https://github.com/lingtalfi/Bat/blob/master/ClassTool.md )          |       Tools for working with classes
[ColorTool]( https://github.com/lingtalfi/Bat/blob/master/ColorTool.md )          |       Tools related to colors
[ConsoleTool]( https://github.com/lingtalfi/Bat/blob/master/ConsoleTool.md )          |       Tools for working with console related tasks
[ConvertTool]( https://github.com/lingtalfi/Bat/blob/master/ConvertTool.md )          |       Tools for working with conversion related tasks
[DateTool]( https://github.com/lingtalfi/Bat/blob/master/DateTool.md )          |       Tools for working with dates
[DebugTool]( https://github.com/lingtalfi/Bat/blob/master/DebugTool.md )          |       Tools for debugging
[ExceptionTool]( https://github.com/lingtalfi/Bat/blob/master/ExceptionTool.md )          |       Tools for manipulating exception
[FileSystemTool]( https://github.com/lingtalfi/Bat/blob/master/FileSystemTool.md )          |       Tools for the filesystem
[FileTool]( https://github.com/lingtalfi/Bat/blob/master/FileTool.md )          |                   Tools for the files
[HashTool]( https://github.com/lingtalfi/Bat/blob/master/HashTool.md )          |                   Tools for the using hashes
[HepTool]( https://github.com/lingtalfi/Bat/blob/master/HepTool.md )          |                   Tools for the using hep parameters
[HttpTool]( https://github.com/lingtalfi/Bat/blob/master/HttpTool.md )          |                   Tools for the using http protocol
[LocalHostTool](  https://github.com/lingtalfi/Bat/blob/master/LocalHostTool.md )          |       Use OsTool instead. LocalHostTool is unofficially deprecated.
[MathTool](  https://github.com/lingtalfi/Bat/blob/master/MathTool.md )          |       Tools for math problems
[MimeTypeTool](  https://github.com/lingtalfi/Bat/blob/master/MimeTypeTool.md )          |       Tool handling mime type
[ObTool](  https://github.com/lingtalfi/Bat/blob/master/ObTool.md )          |          Tool for buffer manipulation
[OsTool](  https://github.com/lingtalfi/Bat/blob/master/OsTool.md )          |          Tool aware of the OS.
[PermTool](  https://github.com/lingtalfi/Bat/blob/master/PermTool.md )          |       Tool for permissions manipulation
[RandomTool]( https://github.com/lingtalfi/Bat/blob/master/RandomTool.md )          |       Tools for manipulating random numbers
[SessionTool]( https://github.com/lingtalfi/Bat/blob/master/SessionTool.md )          |       Tools for session manipulation
[ShortCodeTool]( https://github.com/lingtalfi/Bat/blob/master/ShortCodeTool.md )          |       Tools for manipulating shortcodes
[SmartCodeTool]( https://github.com/lingtalfi/Bat/blob/master/SmartCodeTool.md )          |       Tools for manipulating smart codes
[StringTool]( https://github.com/lingtalfi/Bat/blob/master/StringTool.md )          |       Tools for string manipulation
[UploadTool]( https://github.com/lingtalfi/Bat/blob/master/UploadTool.md )          |       Tools for helping with php file uploads
[UriTool]( https://github.com/lingtalfi/Bat/blob/master/UriTool.md )          |       Tools for uri manipulation
[ValidationTool]( https://github.com/lingtalfi/Bat/blob/master/ValidationTool.md )          |       Tools for validating data
[XmlTool]( https://github.com/lingtalfi/Bat/blob/master/XmlTool.md )          |       Tools for working with xml
[ZipTool]( https://github.com/lingtalfi/Bat/blob/master/ZipTool.md )          |       Zip related tool



Dependencies
------------------

- [CopyDir 1.0.0](https://github.com/lingtalfi/CopyDir)
- [Tiphaine 1.0.0](https://github.com/lingtalfi/Tiphaine)



History Log
------------------
    
- 1.225 -- 2020-04-13

    - add FileSystemTool::mkTmpCopy
    
- 1.224 -- 2020-04-07

    - add MimeTypeTool::isMimeImage
    
- 1.223 -- 2020-03-10

    - add RandomTool::randomDate, randomDatetime, randomString
    
- 1.222 -- 2020-03-02

    - fix ClassTool::getMethodSignature not handling variadic correctly
    
- 1.221 -- 2020-02-07

    - add FileSystemTool::getDirectorySize
    
- 1.220 -- 2020-01-31

    - update FileSystemTool::isValidFilename, now discards empty string and strings starting or ending with space
    
- 1.219 -- 2020-01-31

    - add FileSystemTool::isValidFilename
    
- 1.218 -- 2019-12-20

    - update ArrayTool::objectToArray, add deep argument
    
- 1.217 -- 2019-12-10

    - update SessionTool::get, now accepts a throwEx argument
    
- 1.216 -- 2019-12-09

    - update UriTool::randomize, now accepts a key argument
    
- 1.215 -- 2019-12-09

    - add UriTool::randomize
    
- 1.214 -- 2019-11-14

    - fix ArrayTool::replaceRecursive replacing bool value with 1
    
- 1.213 -- 2019-11-05

    - add ArrayTool::replaceRecursive
    
- 1.212 -- 2019-11-04

    - add ArrayTool::intersect
    
- 1.211 -- 2019-10-31

    - update ArrayTool::arrayKeyExistAll, now accepts a throwEx argument
    
- 1.210 -- 2019-10-28

    - fix FileSystemTool::hasDirectoryTraversal not checking for root relative path
    
- 1.209 -- 2019-10-21

    - add UriTool::httpBuildQuery
    
- 1.208 -- 2019-10-17

    - add MimeTypeTool::getMimeTypeByFileExtension
    
- 1.207 -- 2019-10-16

    - update FileSystemTool::hasDirectoryTraversal, now accepts a checkFileExists argument
    
- 1.206 -- 2019-10-16

    - moved FileSystemTool::hasDirectoryTraversal to isDirectoryTraversalSafe
    
- 1.205 -- 2019-10-16

    - add FileSystemTool::hasDirectoryTraversal
    - remove FileSystemTool::noEscalating and UriTool::noEscalating
    
- 1.204 -- 2019-10-09

    - update FileSystemTool::mkTmpFile, now accepts an extension argument
    
- 1.203 -- 2019-10-07

    - update FileSystemTool::mkTmpFile, now accepts a prefix argument
    
- 1.202 -- 2019-10-03

    - add HashTool::getPasswordHashAlgorithm method
    
- 1.201 -- 2019-10-01

    - add CaseTool::toPortableFilename method

- 1.200 -- 2019-10-01

    - update ArrayTool::walkRowsRecursive, now the callable accepts row passed as a reference
    
- 1.199 -- 2019-09-26

    - add summary for array tool doc
    
- 1.198 -- 2019-09-23

    - add HepTool
    
- 1.197 -- 2019-09-18

    - add StringTool::isStringable
    - add SmartCodeTool::replaceSmartCodeFunction
    
- 1.196 -- 2019-09-18

    - add SmartCodeTool::parseArguments
    
- 1.195 -- 2019-09-17

    - add DebugTool::dumpX
    
- 1.194 -- 2019-09-17

    - add ArrayTool::reduce
    
- 1.193 -- 2019-09-06

    - add ArrayTool::walkRowsRecursive
    
- 1.192 -- 2019-08-27

    - add StringTool::incrementNumericalSuffix
    
- 1.191 -- 2019-08-14

    - fix RandomTool::pickRandomFromArray not accepting nbRequests=0
    
- 1.190 -- 2019-08-14

    - add RandomTool::pickRandomFile method
    
- 1.189 -- 2019-08-14

    - add RandomTool::pickRandomFromArray's nbRequests and pickOnce arguments
    
- 1.188 -- 2019-08-14

    - add RandomTool::pickRandomFromArray
    
- 1.187 -- 2019-08-14

    - add RandomTool::randomBool
    
- 1.186 -- 2019-08-09

    - add ArrayTool::filterRecursive
    
- 1.185 -- 2019-08-09

    - update ArrayTool::updateNodeRecursive documentation
    
- 1.184 -- 2019-08-09

    - fix ClassTool::executePhpMethod not working correctly with multiple arguments in php style
    
- 1.183 -- 2019-08-08

    - add BDotTool::getPathComponents
    
- 1.182 -- 2019-08-07

    - add ArrayTool::filterByAllowed
    
- 1.181 -- 2019-08-07

    - fix ClassTool::getAncestors not returning all ancestor interfaces when the $includeInterfaces option is true 
    
- 1.180 -- 2019-08-02

    - add FileTool::isImage method
    
- 1.179 -- 2019-08-02

    - update FileSystemTool documentation
    
- 1.178 -- 2019-08-02

    - enhance HashTool::getRandomHash64, now accepts a length parameter
    
- 1.177 -- 2019-07-17

    - add ArrayTool::isNumericalArray method
    
- 1.176 -- 2019-07-13

    - add ArrayTool::objectToArray method
    
- 1.175 -- 2019-07-11

    - add DateTool::getTimeElapsedString notFullLength option
    
- 1.174 -- 2019-07-04

    - add ClassTool::executePhpMethod method
    - add SmartCodeTool class
    
- 1.173 -- 2019-07-03

    - add ShortCodeTool class
    
- 1.172 -- 2019-05-24

    - add ColorTool class
    
- 1.171 -- 2019-04-24

    - update FileSystemTool::removeExtension method, now takes into account hidden files
    
- 1.170 -- 2019-04-04

    - add ClassTool::getAncestors method
    
- 1.169 -- 2019-04-03

    - add StringTool::humanizeFileName method
    
- 1.168 -- 2019-04-02

    - add FileSystemTool::resolveTilde method

- 1.167 -- 2019-04-01

    - add OsTool class

- 1.166 -- 2019-04-01

    - update ZipTool::zipByPaths method, now fails if any file couldn't be added to the zip archive.

- 1.165 -- 2019-03-29

    - update ZipTool::zipByPaths method, now fails if no files are added (empty zip)

- 1.164 -- 2019-03-28

    - add FileTool::prepend method

- 1.163 -- 2019-03-27

    - fix ZipTool::zip and ZipTool::zipByPaths now overwrite the zip file if it exists (rather than appending to the existing archive)

- 1.162 -- 2019-03-21

    - update ZipTool::unzip method, now throws BatException if the zip archive doesn't exist

- 1.161 -- 2019-03-21

    - add ConsoleTool::passThru method

- 1.160 -- 2019-03-21

    - add ZipTool::zipByPaths method

- 1.159 -- 2019-03-21

    - update ZipTool, ignore option replaced with ignoreName. ignorePath option added

- 1.158 -- 2019-03-20

    - update ZipTool, now zip method has ignore and ignoreHidden options

- 1.157 -- 2019-03-20

    - update ZipTool, now methods return boolean and throws BatException

- 1.156 -- 2019-03-19

    - add ConsoleTool

- 1.155 -- 2019-02-22

    - add ConvertTool::convertHexColorToRgb method
    
- 1.154 -- 2019-02-19

    - fix FileSystemTool::removeExtension not returning right results 
        
- 1.153 -- 2019-02-19

    - update ClassTool::getMethodSignature, now handles allowsNull 
    
- 1.152 -- 2019-02-19

    - add FileSystemTool::removeExtension method, alias of FileSystemTool::getFileName 
    
- 1.151 -- 2019-02-18

    - fix ClassTool::getMethodSignature method no space between class hint and param name
    
- 1.150 -- 2019-02-18

    - update ClassTool::getMethodSignature method, better parameter type handling
    
- 1.149 -- 2019-02-15

    - add StringTool::indent method
    
- 1.148 -- 2019-02-13

    - add ClassTool::getAbstractAncestors method
    
- 1.147 -- 2019-02-13

    - fix ClassTool::getMethodSignature not handling array parameters correctly
    - DebugTool::toString method now returns the inline version of a php array for arrays (no more carriage returns)
    
- 1.146 -- 2019-02-08

    - add ClassTool::getClassSignature method

- 1.145 -- 2019-02-08

    - improve ClassTool::getMethodSignature output

- 1.144 -- 2019-01-17

    - add ArrayTool::arrayMergeReplaceRecursive method

- 1.143 -- 2019-01-16

    - add ZipTool::zip method
    - rewritten ZipTool::unzip method (now use ZipArchive, avoiding system calls)

- 1.142 -- 2019-01-16

    - add FileTool::append method

- 1.141 -- 2018-06-19

    - add DateTool::getTimeElapsedString method
    
- 1.140 -- 2018-06-17

    - add DateTool::getMysqlDatetime method

- 1.139 -- 2018-06-15

    - add FileSystemTool::moveToDir method
    - add FileSystemTool::move method

- 1.138 -- 2018-06-15

    - add FileSystemTool::getRelativePath method

- 1.137 -- 2018-06-15

    - add FileSystemTool::mkTmpFile method

- 1.136 -- 2018-06-09

    - change HashTool::getHashByArray now internally uses asort instead of ksort

- 1.135 -- 2018-06-03

    - change FileSystemTool::mkdir method's recursive option defaults to true

- 1.134 -- 2018-06-03

    - add UploadTool::getPhpFilesArrayFromFilesSuperArrayItem method

- 1.133 -- 2018-06-03

    - add UploadTool::getPhpFilesArrayFromCombinedStructure method

- 1.132 -- 2018-06-03

    - add ConvertTool

- 1.131 -- 2018-05-29

    - add ArrayTool::updateNodeRecursive method
    
- 1.130 -- 2018-05-24

    - add DebugTool::getArrayPartial method

- 1.129 -- 2018-05-22

    - fix DebugTool::dumpVar dumping without returning

- 1.128 -- 2018-05-22

    - add DebugTool::dumpVar method

- 1.127 -- 2018-05-01

    - add CaseTool toDash method
    - add CaseTool toFlexibleDash method
    - add CaseTool toPascal method
    - add CaseTool toFlexiblePascal method
    - add CaseTool toFlexibleCamel method
    - add CaseTool toConstant method
    - fix some other cases

- 1.126 -- 2018-04-30

    - add ArrayTool::insertRowAfter method

- 1.125 -- 2018-04-27

    - add SessionTool::remove method
    
- 1.124 -- 2018-04-14

    - add ObTool::writeWithoutBuffering method

- 1.123 -- 2018-04-12

    - fix MathTool::getPercentagesByKeyValue problem with divide by zero
    
- 1.122 -- 2018-04-04

    - fix StringTool::unserializeAsArray returning empty string (now returns an array)
    
- 1.121 -- 2018-04-04

    - fix StringTool::unserializeAsArray returning null (now returns an array)
    
- 1.120 -- 2018-04-02

    - now RandomTool::getRandomHash64 method uses php7 random_bytes if available

- 1.119 -- 2018-03-27

    - add RandomTool::getRandomColor method
    
- 1.118 -- 2018-03-25

    - add FileTool::getFileSize method (migrated from FileSystemTool), and added a humanize parameter
    
- 1.117 -- 2018-03-25

    - add ArrayTool::keysSameAsValues method
    
- 1.116 -- 2018-03-22

    - add DebugTool::dump method
    
- 1.115 -- 2018-03-15

    - add SessionTool::setFlag method
    - add SessionTool::pickupFlag method
    
- 1.114 -- 2018-03-06

    - add ClassTool::getMethodNames method
    
- 1.113 -- 2018-03-05

    - add LocalHostTool::hasProgram method
    
- 1.112 -- 2018-03-01

    - add RandomTool::lorem method
    
- 1.111 -- 2018-02-28

    - add DateTool::foreachDateRange method
    
- 1.110 -- 2018-02-28

    - add DateTool::getDate method
    
- 1.109 -- 2018-02-27

    - add RandomTool::getIp method
    
- 1.108 -- 2018-02-27

    - add FileSystemTool::cleanDirBubble method
    
- 1.107 -- 2018-02-27

    - add FileSystemTool::countFiles method
    
- 1.106 -- 2018-02-26

    - add FileSystemTool::rename method
    
- 1.105 -- 2018-02-26

    - add SessionTool:set/get methods
    
- 1.104 -- 2018-02-26

    - enhance DebugTool now recognizes bool and null values
    
- 1.103 -- 2018-02-26

    - add DebugTool
    
- 1.102 -- 2018-02-22

    - fix CaseTool::snakeToFlexiblePascal letting spaces through
    
- 1.101 -- 2018-02-16

    - add ArrayTool::removeEntry method
    
- 1.100 -- 2018-02-13

    - add StringTool::getPlural method
    
- 1.99 -- 2018-01-18

    - add ArrayTool::arrayKeyExistAll method
    
- 1.98 -- 2018-01-11

    - update HashTool::passwordVerify and passwordEncrypt
    
- 1.97 -- 2017-12-13

    - update MathTool::getPercentagesByKeyValue, add percentSign argument  
    
- 1.96 -- 2017-12-13

    - add MathTool::getPercentagesByKeyValue method  
    
- 1.95 -- 2017-12-12

    - add HashTool::getRandomHash64 method  
    
- 1.94 -- 2017-12-12

    - add StringTool::unserializeAsArray method  
    
- 1.93 -- 2017-12-11

    - add HttpTool::isHttps method  
    
- 1.92 -- 2017-12-10

    - update FileSystemTool::mkdir, now returns true even if the directory is a link  
    
- 1.91 -- 2017-12-07

    - fix DateTool.getSameDayNextMonth problems with the first year increment  
    
- 1.90 -- 2017-11-30

    - fix CaseTool.toCamel method
    
- 1.89 -- 2017-11-30

    - add StringTool.relativePath method
    
- 1.88 -- 2017-11-28

    - add DateTool
    
- 1.87 -- 2017-11-01

    - add LocaleTool::getLangIso639_1ByIso639_2 method
    
- 1.86 -- 2017-10-30

    - add ArrayTool::mirrorRange method
    
- 1.85 -- 2017-10-30

    - add CaseTool::toCamel method
    
- 1.84 -- 2017-10-28

    - add LocaleTool
    
- 1.83 -- 2017-10-27

    - add BDotTool
    - add SessionTool.dump method
    
- 1.82 -- 2017-10-12

    - add HashTool 
    
- 1.81 -- 2017-09-11

    - update UriTool::appendQueryString, now recognize the question mark in baseUri 
    
- 1.80 -- 2017-09-11

    - update UriTool::uri now strip trailing question marks 
    
- 1.79 -- 2017-09-11

    - add MathTool
    
- 1.78 -- 2017-08-24

    - StringTool.getUniqueCssId now has a default prefix of a (otherwise it's might not be a regular css identifier)
    
- 1.77 -- 2017-08-20

    - add UploadTool
    
- 1.76 -- 2017-08-18

    - add CaseTool.snakeToFlexiblePascal
    
- 1.75 -- 2017-08-08

    - enhance UriTool.appendQueryString, now understands associative array
    
- 1.74 -- 2017-08-01

    - add CaseTool.toSnake processUpperLetters boolean argument
    
- 1.73 -- 2017-06-27

    - add HttpTool
    
- 1.72 -- 2017-06-27

    - add XmlTool
    
- 1.71 -- 2017-06-24

    - UriTool.appendQueryString function now supports one level numeric index array
    
- 1.70 -- 2017-06-24

    - undo UriTool.uri function now supports merging with one level numeric index array 
    
- 1.69 -- 2017-06-24

    - UriTool.uri function now supports merging with one level numeric index array 
    
- 1.68 -- 2017-06-22

    - add FileSystemTool.clearDir abortIfSymlink argument
    
- 1.67 -- 2017-06-09

    - add CaseTool::snakeToCamelCase method
    
- 1.66 -- 2017-06-08

    - add ArrayTool::superimpose method
    
- 1.65 -- 2017-06-07

    - add UriTool::getHost method
    
- 1.64 -- 2017-06-03

    - add FileSystemTool::noEscalating method
    
- 1.63 -- 2017-05-30

    - add SessionTool::destroyAll method
    
- 1.62 -- 2017-05-23

    - add StringTool::ucfirst method
    
- 1.61 -- 2017-05-22

    - add SessionTool::start method
    
- 1.60 -- 2017-05-17

    - add SessionTool
    
- 1.59 -- 2017-05-11

    - add FileSystemTool.copyFile method
    
- 1.58 -- 2017-05-10

    - add UriTool.noEscalating method
    
- 1.57 -- 2017-05-04

    - add ArrayTool.arrayUniqueRecursive method
    
- 1.56 -- 2017-05-03

    - add keyPrefix argument to StringTool.htmlAttributes method
    
- 1.55 -- 2017-04-28

    - add StringTool.getUniqueCssId
    
- 1.54 -- 2017-04-23

    - add ClassTool.getShortName method
    
- 1.53 -- 2017-04-20

    - add FileTool.cleanVerticalSpaces method
    
- 1.52 -- 2017-04-20

    - FileTool.extract method now has a replaceFile option
    
- 1.51 -- 2017-04-20

    - FileTool.cut method now has a replaceFile option
    
- 1.50 -- 2017-04-20

    - add FileTool.insert method
    
- 1.49 -- 2017-04-18

    - add UriTool.uri method
    
- 1.48 -- 2017-04-08

    - fix UriTool.appendQueryString with empty param value
    
- 1.47 -- 2017-04-04

    - add FileTool.extract
    
- 1.46 -- 2017-04-04

    - add flags argument to FileSystemTool.mkfile
    
- 1.45 -- 2017-04-04

    - add ObTool
    
- 1.44 -- 2017-03-27

    - add ClassTool.getMethodInnerContent
    
- 1.43 -- 2017-03-26

    - fix ClassTool.getMethodContent return false if the function does not exist.
    
- 1.42 -- 2017-03-24

    - fix FileTool.split
    
- 1.41 -- 2017-03-24

    - add FileTool.split
    
- 1.40 -- 2016-12-29

    - fix ZipTool
    
- 1.39 -- 2016-12-29

    - add ZipTool
    
- 1.38 -- 2016-12-25

    - add ClassTool::rewriteMethodContent
    
- 1.37 -- 2016-12-24

    - add ClassTool
    
- 1.36 -- 2016-12-23

    - add FileTool::getNbLines
    
- 1.35 -- 2016-12-23

    - add FileSystemTool::tempDir
    
- 1.34 -- 2016-12-22

    - add ClassTool
    
- 1.33 -- 2016-12-02

    - add UriTool::fileGetContents
    
- 1.32 -- 2016-11-26

    - add UriTool::getWebsiteAbsoluteUrl
    
- 1.31 -- 2016-06-16

    - add PermTool
    - FileSystemTool::filePerms method is now an alias of PermTool::filePerms
    
- 1.30 -- 2016-02-13

    - add FileSystemTool::fileGenerator method
    
- 1.29 -- 2016-01-16

    - add ExceptionTool::toString method
    
- 1.28 -- 2016-01-16

    - add ExceptionTool
    
- 1.27 -- 2016-01-07

    - add CaseTool::toFlea
    
- 1.26 -- 2016-01-07

    - add CaseTool::toDog
    
- 1.25 -- 2016-01-07

    - add StringTool::removeAccents
    
- 1.24 -- 2016-01-06

    - add CaseTool::toSnake
    
- 1.23 -- 2015-12-29

    - add CaseTool::snakeToRegular and unsnake alias

- 1.22 -- 2015-12-22

    - add CaseTool
    - migrated StringTool::camelCase2Constant to CaseTool::camel2Constant
    
    
- 1.21 -- 2015-12-20

    - add ArrayTool::getMissingKeys
        
        
- 1.20 -- 2015-12-16

    - add ValidationTool::isEmail
    
- 1.19 -- 2015-12-16

    - add FileSystemTool::mkfile
        
- 1.18 -- 2015-12-14

    - add StringTool::autoCast
    
    
- 1.17 -- 2015-12-04

    - add UriTool::appendQueryString
    
- 1.16 -- 2015-11-30

    - add StringTool::split
    
- 1.15 -- 2015-11-19

    - add StringTool::replacePortion
    
    
- 1.14 -- 2015-11-12

    - add StringTool::strPosAll
    
    
- 1.13 -- 2015-11-04

    - add FileSystemTool::filePerms
    
    
- 1.12 -- 2015-11-02

    - add StringTool::cutNumericalSuffix
    
        
- 1.11 -- 2015-10-28

    - add StringTool::htmlAttributes    
    
    
- 1.10 -- 2015-10-27

    - add FileSystemTool::existsUnder
    
- 1.09 -- 2015-10-25

    - add MimeTypeTool
    - add FileSystemTool::getFileName
    - add FileSystemTool::getFileSize
    - Fix FileSystemTool::getFileExtension bug (now it takes the whole path into account)
    
    
- 1.08 -- 2015-10-20

    - add FileSystemTool::copyDir
    
- 1.07 -- 2015-10-17

    - add FileSystemTool::mkdirDone
    
    
    
- 1.06 -- 2015-10-14

    - add StringTool::camelCase2Constant
    
    
- 1.05 -- 2015-10-12

    - add FileSystemTool::remove
    - add FileSystemTool::clearDir
    
    
- 1.04 -- 2015-10-09

    - add FileSystemTool::getFileExtension

- 1.03 -- 2015-10-09

    - add LocalHostTool::isWindows
    - add LocalHostTool::isMac
    - add LocalHostTool::isUnix
    
- 1.01 -- 2015-10-08

    - add FileSystemTool::touchDone
    
- 1.00 -- 2015-10-07

    - add FileSystemTool::mkdir