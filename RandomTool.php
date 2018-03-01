<?php

namespace Bat;


class RandomTool
{

    private static $lorem = <<<EEE
lorem ipsum dolor sit amet consectetur adipiscing elit donec fermentum augue id interdum dictum nunc et lacinia massa a lectus aenean ullamcorper ligula non elementum praesent lorem orci scelerisque ac lobortis at nibh ut quam condimentum gravida mollis eget eu dui est molestie varius hendrerit sed quis ultricies commodo sem consequat cursus erat purus tempor felis maximus dapibus turpis odio etiam rutrum velit in placerat malesuada rhoncus tincidunt nunc cras nisi iaculis ante neque ut congue fusce accumsan sapien ex ornare blandit nullam sagittis diam justo dignissim egestas morbi pharetra pellentesque tellus suscipit mattis ultrices urna fringilla luctus arcu integer faucibus curabitur pretium sed efficitur venenatis volutpat risus nec quisque facilisis convallis leo nulla vitae libero aliquam tortor laoreet pulvinar mi vestibulum nulla auctor magna mauris sodales sollicitudin porta metus bibendum aliquam porttitor mauris   
EEE;


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


    public static function lorem($nbWords = null, $minWords = 1, $maxWords = 250)
    {

        if (null === $nbWords) {
            $nbWords = rand($minWords, $maxWords);
        }

        $nbWords = (int)$nbWords;
        if ($nbWords < 1) {
            $nbWords = 1;
        }

        $words = preg_split("/[^\w]*([\s]+[^\w]*|$)/", self::$lorem, -1, PREG_SPLIT_NO_EMPTY);
        $n = count($words) - 1;
        $arrWords = [];
        for ($i = 1; $i <= $nbWords; $i++) {
            $arrWords[] = $words[rand(0, $n)];
        }
        return implode(" ", $arrWords);
    }
}
