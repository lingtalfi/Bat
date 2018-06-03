<?php


namespace Bat;


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
     * [size-unit™]
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
                }
                elseif ($bytes < (1000 * 1000)) {
                    $unit = 'k';
                }
                elseif ($bytes < (1000 * 1000 * 1000)) {
                    $unit = 'm';
                }
                elseif ($bytes < (1000 * 1000 * 1000 * 1000)) {
                    $unit = 'g';
                }
                elseif ($bytes < (1000 * 1000 * 1000 * 1000 * 1000)) {
                    $unit = 't';
                }
                elseif ($bytes < (1000 * 1000 * 1000 * 1000 * 1000 * 1000)) {
                    $unit = 'p';
                }
                elseif ($bytes < (1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000)) {
                    $unit = 'e';
                }
                elseif ($bytes < (1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000)) {
                    $unit = 'z';
                }
                elseif ($bytes < (1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000 * 1000)) {
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
        }
        else {
            throw new \InvalidArgumentException("unit must be of type string");
        }
    }


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
