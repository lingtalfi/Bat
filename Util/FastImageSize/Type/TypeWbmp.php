<?php


namespace Ling\Bat\Util\FastImageSize\Type;

use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 * The TypeWbmp class.
 */
class TypeWbmp extends TypeBase
{
    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        $data = FastImageSizeHelper::getImageData($filename, 0, self::LONG_SIZE);

        // Check if image is WBMP
        if ($data === false || !$this->validWBMP($data)) {
            return false;
        }

        $size = unpack('Cwidth/Cheight', substr($data, self::SHORT_SIZE, self::SHORT_SIZE));

        // Check if dimensions are valid. A file might be recognised as WBMP
        // rather easily (see extra check for JPEG2000).
        if (!$this->validDimensions($size)) {
            return false;
        }
        return $size;
    }

    /**
     * Return if supplied data might be part of a valid WBMP file
     *
     * @param string $data
     *
     * @return bool True if data might be part of a valid WBMP file, else false
     */
    private function validWBMP(string $data): bool
    {
        return ord($data[0]) === 0 && ord($data[1]) === 0 && $data !== substr(TypeJp2::JPEG_2000_SIGNATURE, 0, self::LONG_SIZE);
    }

    /**
     * Return whether dimensions are valid
     *
     * @param array $size Size array
     *
     * @return bool True if dimensions are valid, false if not
     */
    private function validDimensions(array $size): bool
    {
        return $size['height'] > 0 && $size['width'] > 0;
    }
}
