Bat
==========
2015-10-07


![Basic Tools](http://s18.postimg.org/qhu0b9g5l/bat_web.jpg "Basic Tools")





Bat (Basic Tools) is an ensemble of basic tools that one can use to 
hopefully do a job faster (from the coding point of view, not performance).

A tool is a **static class**, which means that you can call its methods
without having to instantiate it.





So far, the Bat library is composed of the following tools:



Tools       |       Description
----------- | -----------------------
[ArrayTool]( https://github.com/lingtalfi/Bat/blob/master/ArrayTool.md )          |       Tools for manipulating arrays
[CaseTool]( https://github.com/lingtalfi/Bat/blob/master/CaseTool.md )          |       Tools for for converting a case to another
[ExceptionTool]( https://github.com/lingtalfi/Bat/blob/master/ExceptionTool.md )          |       Tools for manipulating exception
[FileSystemTool]( https://github.com/lingtalfi/Bat/blob/master/FileSystemTool.md )          |       Tools for the filesystem
[LocalHostTool](  https://github.com/lingtalfi/Bat/blob/master/LocalHostTool.md )          |       Tools aware of the local host
[MimeTypeTool](  https://github.com/lingtalfi/Bat/blob/master/MimeTypeTool.md )          |       Tool handling mime type
[PermTool](  https://github.com/lingtalfi/Bat/blob/master/PermTool.md )          |       Tool for permissions manipulation
[StringTool]( https://github.com/lingtalfi/Bat/blob/master/StringTool.md )          |       Tools for string manipulation
[UriTool]( https://github.com/lingtalfi/Bat/blob/master/UriTool.md )          |       Tools for uri manipulation
[ValidationTool]( https://github.com/lingtalfi/Bat/blob/master/ValidationTool.md )          |       Tools for validating data



Dependencies
------------------

- [CopyDir 1.0.0](https://github.com/lingtalfi/CopyDir)
- [Tiphaine 1.0.0](https://github.com/lingtalfi/Tiphaine)



History Log
------------------
    
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