<?php


namespace Ling\Bat;


use Ling\Bat\Exception\BatException;

/**
 * The ColorTool class.
 */
class ColorTool
{


    /**
     * Returns the hsl array from an hex color code (prefixed or not prefixed with the hash symbol).
     * The returned hsl array has three entries:
     *
     * - h
     * - s
     * - l
     *
     *
     * @param string $hex
     * @return array
     */
    public static function hexToHsl(string $hex): array
    {
        // convert hex to hsl
        $hex = str_split(ltrim($hex, '#'), 2);

        // convert the rgb values to the range 0-1
        $rgb = array_map(function ($part) {
            return hexdec($part) / 255;
        }, $hex);

        // find the minimum and maximum values of r, g and b
        $min = min($rgb);
        $max = max($rgb);

        // calculate the luminace value by adding the max and min values and divide by 2
        $l = ($min + $max) / 2;
        if ($max === $min) {
            $h = $s = 0;
        } else {
            if ($l <= 0.5) {
                $s = ($max - $min) / ($max + $min);
            } elseif ($l > 0.5) {
                $s = ($max - $min) / (2 - $max - $min);
            }

            if ($max === $rgb[0]) {
                $h = ($rgb[1] - $rgb[2]) / ($max - $min);
            } elseif ($max === $rgb[1]) {
                $h = 2 + ($rgb[2] - $rgb[0]) / ($max - $min);
            } elseif ($max === $rgb[2]) {
                $h = 4 + ($rgb[0] - $rgb[1]) / ($max - $min);
            }
            $h = $h * 60;
            if ($h < 0) {
                $h = $h + 360;
            }
        }
        return [$h, $s, $l];
    }


    /**
     * Returns an array of rgb colors from the given $hexColor (prefixed or not prefixed with the hash symbol).
     *
     * The returned array has the following structure:
     * - r
     * - g
     * - b
     *
     *
     *
     *
     * @param string $hexColor
     * @return array
     * @throws BatException
     */
    public static function hexToRgb(string $hexColor): array
    {
        $expectedLength = 6;
        $format = "%02x%02x%02x";
        if ('#' === substr($hexColor, 0, 1)) {
            $expectedLength++;
            $format = "#" . $format;
        }

        if ($expectedLength !== strlen($hexColor)) {
            $len = strlen($hexColor);
            throw new BatException("The hexColor must be exactly $expectedLength long, but the given length was $len.");
        }

        return sscanf($hexColor, $format);
    }


    /**
     * Returns the hex color code corresponding to the given hsl array.
     * The given hsl array must have three entries:
     *
     * - h
     * - s
     * - l
     *
     *
     * @param array $hsl
     * @return string
     */
    public static function hslToHex(array $hsl): string
    {
        return self::rgbToHex(self::hslToRgb($hsl));
    }


    /**
     * Returns the rgb array corresponding to the given hsl array.
     * The returned rgb array has three entries:
     * - r
     * - g
     * - b
     *
     * The given hsl array must have three entries:
     * - h
     * - s
     * - l
     *
     *
     *
     *
     *
     * @param array $hsl
     * @return array
     */
    public static function hslToRgb(array $hsl): array
    {
        $h = $hsl[0];
        $s = $hsl[1];
        $l = $hsl[2];
        $c = (1 - abs(2 * $l - 1)) * $s;
        $x = $c * (1 - abs(fmod(($h / 60), 2) - 1));
        $m = $l - ($c / 2);
        if ($h < 60) {
            $r = $c;
            $g = $x;
            $b = 0;
        } else if ($h < 120) {
            $r = $x;
            $g = $c;
            $b = 0;
        } else if ($h < 180) {
            $r = 0;
            $g = $c;
            $b = $x;
        } else if ($h < 240) {
            $r = 0;
            $g = $x;
            $b = $c;
        } else if ($h < 300) {
            $r = $x;
            $g = 0;
            $b = $c;
        } else {
            $r = $c;
            $g = 0;
            $b = $x;
        }
        $r = ($r + $m) * 255;
        $g = ($g + $m) * 255;
        $b = ($b + $m) * 255;
        return array(floor($r), floor($g), floor($b));
    }


    /**
     * Returns whether the given hex color code (prefixed or not prefixed with a hash symbol) is dark.
     *
     * @param string $hex
     * @return bool
     * @throws BatException
     */
    public static function isDark(string $hex): bool
    {
        return (self::getBrightness($hex) < 128);

    }


    /**
     * Returns the hex color code from an rgb array.
     * The given rgb array must have three entries:
     *
     * - r
     * - g
     * - b
     *
     *
     * The returned hex color code is prefixed with a hash symbol.
     *
     *
     * @param array $rgb
     * @return string
     */
    public static function rgbToHex(array $rgb): string
    {
        return sprintf("#%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2]);
    }


    /**
     * Returns a brightness level.
     * See https://bgrins.github.io/spectrum/ for more details.
     *
     *
     *
     * @param $hex
     * @return string
     * @throws BatException
     */
    private static function getBrightness($hex): string
    {
        $rgb = self::hexToRgb($hex);
        return ($rgb[0] * 299 + $rgb[1] * 587 + $rgb[2] * 114) / 1000;
    }

}