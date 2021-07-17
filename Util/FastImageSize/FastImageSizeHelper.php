<?php


namespace Ling\Bat\Util\FastImageSize;


/**
 * The FastImageSizeHelper class.
 */
class FastImageSizeHelper
{
    /**
     * Get the image data from specified path/source.
     *
     * - offset: from which position we should start reading
     * - length: maximum length that should be read
     * - forceLength: (true by default), true if the length needs to be the specified length, false if not.
     *
     *
     * @param string $filename
     * @param int $offset
     * @param int $length
     * @param bool $forceLength
     *
     * @return false|string Image data or false if result was empty
     */
    public static function getImageData(string $filename, int $offset, int $length, bool $forceLength = true): string|false
    {
        $data = file_get_contents($filename, null, null, $offset, $length);
        // Force length to expected one. Return false if data length
        // is smaller than expected length
        if ($forceLength === true) {
            return (strlen($data) < $length) ? false : substr($data, $offset, $length);
        }
        return empty($data) ? false : $data;
    }

}