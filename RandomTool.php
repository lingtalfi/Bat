<?php

namespace Ling\Bat;


use Ling\DirScanner\YorgDirScannerTool;

/**
 * The RandomTool class.
 */
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


    public static function getRandomColor()
    {
        return '#' . substr(md5(rand()), 0, 6);
    }


    /**
     * Picks a random file from the given $dir and returns its path.
     * If extension is provided, it can be either a string or an array of extensions (without the leading dot),
     * and defines which extension(s) to look for.
     *
     * By default, this method doesn't look into subdirectories, but we can change this with the recursive flag
     * set to true.
     *
     *
     *
     * @param string $dir
     * @param null $extension
     * @param bool $recursive
     * @return string
     * @throws \Exception
     */
    public static function pickRandomFile(string $dir, $extension = null, bool $recursive = false): string
    {
        $files = YorgDirScannerTool::getFilesWithExtension($dir, $extension, false, $recursive);
        return self::pickRandomFromArray($files);
    }

    /**
     * Returns a random element from the given array,
     * or multiple randomly chosen elements if the $nbRequests parameter is provided.
     *
     * By default, an element can be picked only once.
     * But we can set the pickOnce flag to false to allow the same item to picked up multiple times.
     *
     * See the examples from the documentation for more details.
     *
     *
     * @param array $array
     * @param int $nbRequests
     * @param bool $pickOnce
     * @return mixed
     */
    public static function pickRandomFromArray(array $array, int $nbRequests = null, bool $pickOnce = true)
    {
        if (null === $nbRequests) {
            return $array[array_rand($array)];
        } else {
            if ($nbRequests < 1) {
                return [];
            }
            $ret = [];
            for ($i = 1; $i <= $nbRequests; $i++) {
                if ($array) {
                    $key = array_rand($array);
                    $ret[] = $array[$key];
                    if (true === $pickOnce) {
                        unset($array[$key]);
                    }
                } else {
                    break;
                }
            }
            return $ret;
        }
    }

    /**
     * Returns a random boolean.
     * If the $probabilityOfTrue is given, it's the probability expressed in percentage (i.e. an int between 0 and 100)
     * that this method will return true (i.e. 100 will always return true, and 0 will always return false).
     *
     *
     * @param int $probabilityOfTrue
     * @return bool
     */
    public static function randomBool(int $probabilityOfTrue = 50): bool
    {
        $probabilityOfTrue--;
        return ($probabilityOfTrue >= rand(0, 99));
    }

}
