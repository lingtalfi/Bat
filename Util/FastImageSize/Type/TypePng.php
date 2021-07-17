<?php


namespace Ling\Bat\Util\FastImageSize\Type;

use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 * The TypePng class.
 */
class TypePng extends TypeBase
{
    /**
     * @var string PNG header
     */
    public const PNG_HEADER = "\x89\x50\x4e\x47\x0d\x0a\x1a\x0a";

    /**
     * @var int PNG IHDR offset
     */
    public const PNG_IHDR_OFFSET = 12;

    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        // Retrieve image data including the header, the IHDR tag, and the
        // following 2 chunks for the image width and height
        $data = FastImageSizeHelper::getImageData($filename, 0, self::PNG_IHDR_OFFSET + 3 * self::LONG_SIZE);
        if (false === $data) {
            return false;
        }

        // Check if header fits expected format specified by RFC 2083
        if (substr($data, 0, self::PNG_IHDR_OFFSET - self::LONG_SIZE) !== self::PNG_HEADER || substr($data, self::PNG_IHDR_OFFSET, self::LONG_SIZE) !== 'IHDR') {
            return false;
        }
        return unpack('Nwidth/Nheight', substr($data, self::PNG_IHDR_OFFSET + self::LONG_SIZE, self::LONG_SIZE * 2));
    }
}
