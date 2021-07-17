<?php


namespace Ling\Bat\Util\FastImageSize\Type;

use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 *
 * The TypeGif class.
 */
class TypeGif extends TypeBase
{
    /**
     * @var string GIF87a header
     */
    public const GIF87A_HEADER = "\x47\x49\x46\x38\x37\x61";

    /**
     * @var string GIF89a header
     */
    public const GIF89A_HEADER = "\x47\x49\x46\x38\x39\x61";

    /**
     * @var int GIF header size
     */
    public const GIF_HEADER_SIZE = 6;

    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        // Get data needed for reading image dimensions as outlined by GIF87a
        // and GIF89a specifications
        $data = FastImageSizeHelper::getImageData($filename, 0, self::GIF_HEADER_SIZE + self::SHORT_SIZE * 2);
        if (false === $data) {
            return false;
        }

        $type = substr($data, 0, self::GIF_HEADER_SIZE);
        if ($type !== self::GIF87A_HEADER && $type !== self::GIF89A_HEADER) {
            return false;
        }

        return unpack('vwidth/vheight', substr($data, self::GIF_HEADER_SIZE, self::SHORT_SIZE * 2));
    }
}
