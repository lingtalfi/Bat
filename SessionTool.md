SessionTool
=====================
2017-05-17



This class contains functions for manipulating sessions.





destroyPartial
-----------
2017-05-17

Destroy some of the variables in the session


```php
void destroyPartial( mixed:keys )
```

keys can be an array or a string, it represents the key(s) to destroy.




Example:

```php
<?php

SessionTool::destroyPartial("myid");
header("Location: http://mysite.com/an/uri");
exit;

```

