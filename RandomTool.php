<?php

namespace Bat;


class RandomTool
{


    public static function getIp()
    {
        /**
         * for more realistic ways, update this...
         */
        $plages = [
            1 => [0, 255],
            2 => [0, 255],
            3 => [0, 255],
            4 => [0, 255],
        ];

        $components = [];
        if ("ipv4") {
            for ($i = 1; $i <= 4; $i++) {
                list($a, $b) = $plages[$i];
                $components[] = rand($a, $b);
            }
        }
        return implode('.', $components);
    }
}
