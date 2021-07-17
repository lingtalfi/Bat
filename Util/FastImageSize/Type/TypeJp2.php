<?php


namespace Ling\Bat\Util\FastImageSize\Type;

use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 * The TypeJp2 class.
 */
class TypeJp2 extends TypeBase
{
    /**
     * @var string JPEG 2000 signature
     */
    public const JPEG_2000_SIGNATURE = "\x00\x00\x00\x0C\x6A\x50\x20\x20\x0D\x0A\x87\x0A";

    /**
     * @var string JPEG 2000 SOC marker
     */
    public const JPEG_2000_SOC_MARKER = "\xFF\x4F";

    /**
     * @var string JPEG 2000 SIZ marker
     */
    public const JPEG_2000_SIZ_MARKER = "\xFF\x51";

    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        $data = FastImageSizeHelper::getImageData($filename, 0, TypeJpeg::JPEG_MAX_HEADER_SIZE, false);
        if (false === $data) {
            return false;
        }

        // Check if file is jpeg 2000
        if (substr($data, 0, strlen(self::JPEG_2000_SIGNATURE)) !== self::JPEG_2000_SIGNATURE) {
            return false;
        }

        // Get SOC position before starting to search for SIZ.
        // Make sure we do not get SIZ before SOC by cutting at SOC.
        $data = substr($data, strpos($data, self::JPEG_2000_SOC_MARKER));

        // Remove SIZ and everything before
        $data = substr($data, strpos($data, self::JPEG_2000_SIZ_MARKER) + self::SHORT_SIZE);

        // Acquire size info from data
        return unpack('Nwidth/Nheight', substr($data, self::LONG_SIZE, self::LONG_SIZE * 2));
    }
}
