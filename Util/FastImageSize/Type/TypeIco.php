<?php


namespace Ling\Bat\Util\FastImageSize\Type;


use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 * The TypeIco class.
 */
class TypeIco extends TypeBase
{
    /**
     * @var string ICO reserved field
     */
    public const ICO_RESERVED = 0;

    /**
     * @var int ICO type field
     */
    public const ICO_TYPE = 1;

    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        // Retrieve image data for ICO header and header of first entry.
        // We assume the first entry to have the same size as the other ones.
        $data = FastImageSizeHelper::getImageData($filename, 0, 2 * self::LONG_SIZE);

        if ($data === false) {
            return false;
        }

        // Check if header fits expected format
        if (!$this->isValidIco($data)) {
            return false;
        }

        return unpack('Cwidth/Cheight', substr($data, self::LONG_SIZE + self::SHORT_SIZE, self::SHORT_SIZE));
    }

    /**
     * Returns whether image is a valid ICO file.
     *
     * @param string $data Image data string
     *
     * @return bool
     */
    private function isValidIco(string $data): bool
    {
        // Get header
        $header = unpack('vreserved/vtype/vimages', $data);

        return $header['reserved'] === self::ICO_RESERVED && $header['type'] === self::ICO_TYPE && $header['images'] > 0 && $header['images'] <= 255;
    }
}
