Bdot notation
=============
2019-02-05




The bdot notation is a notation to access deep elements of an array.


Examples
--------

### Example #1 Bdot notation simple example


Given the following array:


```php

$array = [
    "universe" => [
        "earth" => [
            "france" => [
                "city" => "Tours",
            ],
        ]
    ],
];

```

The bdot notation to display the value "Tours" would be this:

- universe.earth.france.city


### Example #2 Bdot notation with dotted key


If a key contains a dot, we escape it with the backslash.

Given the following array:


```php

$array = [
    "uni.verse" => [
        "earth" => [
            "france" => [
                "city" => "Tours",
            ],
        ]
    ],
];

```

The bdot notation to display the value "Tours" would be this:

- uni\.verse.earth.france.city



Tools
-----

The [Bdot tool](https://github.com/karayabin/universe-snapshot/blob/master/universe/Bat/BDotTool.md) allows us to use the bdot notation in our projects.


