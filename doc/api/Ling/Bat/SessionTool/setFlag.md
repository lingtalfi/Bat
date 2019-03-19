[Back to the Ling/Bat api](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat.md)<br>
[Back to the Ling\Bat\SessionTool class](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/SessionTool.md)


SessionTool::setFlag
================



SessionTool::setFlag — it removes it (i.e.




Description
================


public static [SessionTool::setFlag](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/SessionTool/setFlag.md)(?$identifier, $value = true) : void




The flags mechanism:
you set up a flag with setFlag, then when you retrieve it with pickupFlag
it removes it (i.e. you can only retrieve it once until it's set again).

This behaviour was handy in the following case (there might be other usecases):

- an insert form that redirects upon the update page on success.
Problem, on the redirected page we don't have the success notification that the user expects.
With flags, we set a flag before redirection, then on landing page we retrieve it to see
whether or not we show the alert.




Parameters
================



Return values
================

Returns void.








See Also
================

The [SessionTool](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/SessionTool.md) class.

Previous method: [dump](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/SessionTool/dump.md)<br>Next method: [pickupFlag](https://github.com/lingtalfi/Bat/blob/master/doc/api/Ling/Bat/SessionTool/pickupFlag.md)<br>

