<?php


namespace Ling\Bat\Util\FastImageSize\Type;

use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 *
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 *
 * The TypeBmp class.
 */
class TypeBmp extends TypeBase
{
    /** @var int BMP header size needed for retrieving dimensions */
    public const BMP_HEADER_SIZE = 26;

    /** @var string BMP signature */
    public const BMP_SIGNATURE = "\x42\x4D";

    /** qvar int BMP dimensions offset */
    public const BMP_DIMENSIONS_OFFSET = 18;


    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        $data = FastImageSizeHelper::getImageData($filename, 0, self::BMP_HEADER_SIZE);
        if (false === $data) {
            return false;
        }

        // Check if supplied file is a BMP file
        if (substr($data, 0, 2) !== self::BMP_SIGNATURE) {
            return false;
        }

        return unpack('lwidth/lheight', substr($data, self::BMP_DIMENSIONS_OFFSET, 2 * self::LONG_SIZE));
    }
}
