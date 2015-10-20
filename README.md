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
[FileSystemTool]( https://github.com/lingtalfi/Bat/blob/master/FileSystemTool.md )          |       Tools for the filesystem
[LocalHostTool](  https://github.com/lingtalfi/Bat/blob/master/LocalHostTool.md )          |       Tools aware of the local host
[StringTool]( https://github.com/lingtalfi/Bat/blob/master/StringTool.md )          |       Tools for string manipulation







History Log
------------------

- v1.08 -- 2015-10-20

    add FileSystemTool::copyDir
    
- v1.07 -- 2015-10-17

    add FileSystemTool::mkdirDone
    
    
    
- v1.06 -- 2015-10-14

    add StringTool::camelCase2Constant
    
    
- v1.05 -- 2015-10-12

    add FileSystemTool::remove
    add FileSystemTool::clearDir
    
    
- v1.04 -- 2015-10-09

    add FileSystemTool::getFileExtension

- v1.03 -- 2015-10-09

    add LocalHostTool::isWindows
    add LocalHostTool::isMac
    add LocalHostTool::isUnix
    
- v1.01 -- 2015-10-08

    add FileSystemTool::touchDone
    
- v1.00 -- 2015-10-07

    add FileSystemTool::mkdir