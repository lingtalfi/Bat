<?php

namespace Ling\Bat\Util\FastImageSize\Type;


use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 *
 * The TypePsd class.
 */
class TypePsd extends TypeBase
{
    /**
     * @var string PSD signature
     */
    public const PSD_SIGNATURE = "8BPS";

    /**
     * @var int PSD header size
     */
    public const PSD_HEADER_SIZE = 22;

    /**
     * @var int PSD dimensions info offset
     */
    public const PSD_DIMENSIONS_OFFSET = 14;

    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        $data = FastImageSizeHelper::getImageData($filename, 0, self::PSD_HEADER_SIZE);

        if ($data === false) {
            return false;
        }

        // Offset for version info is length of header but version is only a
        // 16-bit unsigned value
        $version = unpack('n', substr($data, self::LONG_SIZE, 2));

        // Check if supplied file is a PSD file
        if (!$this->validPsd($data, $version)) {
            return false;
        }

        return unpack('Nheight/Nwidth', substr($data, self::PSD_DIMENSIONS_OFFSET, 2 * self::LONG_SIZE));
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Returns whether file is a valid PSD file.
     *
     * @param string $data Image data string
     * @param array $version Version array
     *
     * @return bool
     */
    private function validPsd(string $data, array $version): bool
    {
        return substr($data, 0, self::LONG_SIZE) === self::PSD_SIGNATURE && $version[1] === 1;
    }
}
