<?php

namespace Ling\Bat;


use Ling\Bat\Util\FastImageSize\FastImageSize;

/**
 * The ImageTool class.
 */
class ImageTool
{


    /**
     * Returns the dimensions (w, h) of the given image file, based on the file extension.
     *
     * The file can be an url too.
     *
     * This method assumes that the given image file is actually a real image.
     * If not, unpredictable results might be returned.
     *
     *
     *
     *
     * @param string $imageFile
     * @return array
     */
    public static function getDimensions(string $imageFile): array
    {

        $util = new FastImageSize();
        $size = $util->getImageSize($imageFile);
        if (false !== $size) {
            return $size;
        }
        list($width, $height) = getimagesize($imageFile);
        return [
            $width,
            $height,
        ];
    }
}
