<?php


namespace Ling\Bat;


use Ling\Bat\Exception\BatException;

/**
 * ConvertTool
 * @author Lingtalfi
 * 2014-08-13
 *
 * (stolen from bee framework)
 *
 */
class ConvertTool
{


    /**
     *
     * Convert a bytes number to another unit.
     *
     * If the unit is "h", then a human format is returned (i.e. the unit is chosen based on
     * human readability criteria).
     *
     * [size-unit™]
     *
     *
     * @param $bytes
     * @param string $unit
     * @param int $precision
     * @return string
     */
    public static function convertBytes($bytes, $unit = 'b', $precision = 2)
    {
        $bytes = (int)$bytes;
        if (is_string($unit)) {
            $unit = strtolower($unit);

            $humanise = false;
            if ('h' === $unit) { // human label
                if ($bytes < 1000) {
                    $unit = 'b';
                } elseif ($bytes < (1000 * 1000)) {
                    $unit = 'k';
                } elseif ($bytes < (1000 * 1000 * 1000)) {
                    $unit = 'm';
                } elseif ($bytes < (1000 * 1000 * 1000 * 1000)) {
                    $unit = 'g';
                } elseif ($bytes < (1000 * 1000 * 1000 * 1000 * 1000)) {
                    $unit = 't';
                } elseif ($bytes < (1000 * 1000 * 1000 * 1000 * 1000 * 1000)) {
                    $unit = 'p';
                } elseif ($bytes < (1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000)) {
                    $unit = 'e';
                } elseif ($bytes < (1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000)) {
                    $unit = 'z';
                } elseif ($bytes < (1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000)) {
                    $unit = 'y';
                }
                $humanise = true;
            }


            switch ($unit) {
                case 'o':
                case 'b':
                    break;
                case 'ko':
                    $bytes /= 1000;
                    break;
                case 'mo':
                    $bytes /= (1000 * 1000);
                    break;
                case 'go':
                    $bytes /= (1000 * 1000 * 1000);
                    break;
                case 'to':
                    $bytes /= (1000 * 1000 * 1000 * 1000);
                    break;
                case 'po':
                    $bytes /= (1000 * 1000 * 1000 * 1000 * 1000);
                    break;
                case 'eo':
                    $bytes /= (1000 * 1000 * 1000 * 1000 * 1000 * 1000);
                    break;
                case 'zo':
                    $bytes /= (1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000);
                    break;
                case 'yo':
                    $bytes /= (1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000);
                    break;


                case 'k':
                case 'kb':
                case 'kio':
                    $bytes /= 1024;
                    break;
                case 'm':
                case 'mb':
                case 'mio':
                    $bytes /= (1024 * 1024);
                    break;
                case 'g':
                case 'gb':
                case 'gio':
                    $bytes /= (1024 * 1024 * 1024);
                    break;
                case 't':
                case 'tb':
                case 'tio':
                    $bytes /= (1024 * 1024 * 1024 * 1024);
                    break;
                case 'p':
                case 'pb':
                case 'pio':
                    $bytes /= (1024 * 1024 * 1024 * 1024 * 1024);
                    break;
                case 'e':
                case 'eb':
                case 'eio':
                    $bytes /= (1024 * 1024 * 1024 * 1024 * 1024 * 1024);
                    break;
                case 'z':
                case 'zb':
                case 'zio':
                    $bytes /= (1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024);
                    break;
                case 'y':
                case 'yb':
                case 'yio':
                    $bytes /= (1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024);
                    break;
                default;
                    throw new \UnexpectedValueException(sprintf("Unit was not recognized: %s", $unit));
                    break;
            }

            $ret = round($bytes, (int)$precision);
            if (true === $humanise) {
                $ret = $ret . ucfirst($unit);
            }
            return $ret;
        } else {
            throw new \InvalidArgumentException("unit must be of type string");
        }
    }


    /**
     * Deprecated.
     * Alias of ColorTool::hexToRgb an array of rgb colors from the given $hexColor.
     */
    public static function convertHexColorToRgb(string $hexColor): array
    {
        return ColorTool::hexToRgb($hexColor);
    }

    /**
     * Returns a number of bytes by converting the given $humanSize expression.
     *
     * The $humanSize expression uses a human intuitive notation. All examples below are valid $humanSize expressions:
     *
     * - 48          // 48 bytes
     * - 48b         // 48 bytes
     * - 48 b        // 48 bytes
     * - 48k         // 48 kilobytes
     * - 48 m        // 48 megabytes
     * - 2.6 M       // 2.6 megabytes
     * - 1.4 g       // 1.4 gigabytes
     * - 1.4 t       // 1.4 terabyte
     * - 1.4 p       // 1.4 petabyte
     * - 1.4 e       // 1.4 exabyte
     * - 1.4 z       // 1.4 zettabyte
     * - 1.4 y       // 1.4 yottabyte
     *
     *
     * The $humanSize expression is composed of two elements:
     *
     * - a number
     * - a unit
     *
     * The number represents the size.
     * The number is any number. Decimal numbers are accepted if the dot (.) or the comma (,) is used as a separator.
     *
     * The unit represents the unit for the given size.
     * If omitted, it defaults to bytes.
     * All units are multiple of 1024 (i.e. not 1000).
     * A unit is always expressed with one (and only one letter), which can be either lower case or upper case.
     * It's possible to add whitespace(s) between the number and the unit components.
     * All possible units are exposed in the example above.
     *
     *
     *
     *
     *
     * @param $humanSize
     * @return int
     */
    public static function convertHumanSizeToBytes($humanSize)
    {
        $ret = $humanSize;
        if (preg_match('!^([0-9\.,]+)(.*)$!s', $humanSize, $match)) {
            $unit = substr(strtolower(trim($match[2])), 0, 1);

            $value = (float)(str_replace(",", ".", $match[1]));
            switch ($unit) {
                case 'o':
                case 'b':
                    $ret = $value;
                    break;
                case 'k':
                    $ret = $value * 1024;
                    break;
                case 'm':
                    $ret = $value * 1024 * 1024;
                    break;
                case 'g':
                    $ret = $value * 1024 * 1024 * 1024;
                    break;
                case 't':
                    $ret = $value * 1024 * 1024 * 1024 * 1024;
                    break;
                case 'p':
                    $ret = $value * 1024 * 1024 * 1024 * 1024 * 1024;
                    break;
                case 'e':
                    $ret = $value * 1024 * 1024 * 1024 * 1024 * 1024 * 1024;
                    break;
                case 'z':
                    $ret = $value * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024;
                    break;
                case 'y':
                    $ret = $value * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024;
                    break;
                default;
                    break;
            }

        }
        return (int)$ret;
    }
}
