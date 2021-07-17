<?php


namespace Ling\Bat\Util\FastImageSize\Type;

use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 * The TypeTif class.
 */
class TypeTif extends TypeBase
{
    /**
     * @var int TIF header size. The header might be larger but the dimensions
     *            should be in the first 256 kiB bytes */
    public const TIF_HEADER_SIZE = 262144;

    /**
     * @var int TIF tag for image height
     */
    public const TIF_TAG_IMAGE_HEIGHT = 257;

    /**
     * @var int TIF tag for image width
     */
    public const TIF_TAG_IMAGE_WIDTH = 256;

    /**
     * @var int TIF tag type for short
     */
    public const TIF_TAG_TYPE_SHORT = 3;

    /**
     * @var int TIF IFD entry size
     */
    public const TIF_IFD_ENTRY_SIZE = 12;

    /**
     * @var string TIF signature of intel type
     */
    public const TIF_SIGNATURE_INTEL = 'II';

    /**
     * @var string TIF signature of motorola type
     */
    public const TIF_SIGNATURE_MOTOROLA = 'MM';

    /**
     * @var array Size info array
     */
    private array $size;

    /**
     * @var string Bit type of long field
     */
    public string $typeLong;

    /**
     * @var string Bit type of short field
     */
    public string $typeShort;

    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        // Do not force length of header
        $data = FastImageSizeHelper::getImageData($filename, 0, self::TIF_HEADER_SIZE, false);

        if (false === $data) {
            return false;
        }


        $this->size = [];

        $signature = substr($data, 0, self::SHORT_SIZE);

        if (!in_array($signature, [self::TIF_SIGNATURE_INTEL, self::TIF_SIGNATURE_MOTOROLA])) {
            return false;
        }

        // Set byte type
        $this->setByteType($signature);

        // Get offset of IFD
        list(, $offset) = unpack($this->typeLong, substr($data, self::LONG_SIZE, self::LONG_SIZE));

        // Get size of IFD
        $ifdSizeInfo = substr($data, $offset, self::SHORT_SIZE);
        if (empty($ifdSizeInfo)) {
            return false;
        }
        list(, $sizeIfd) = unpack($this->typeShort, $ifdSizeInfo);

        // Skip 2 bytes that define the IFD size
        $offset += self::SHORT_SIZE;

        // Ensure size can't exceed data length
        $sizeIfd = min($sizeIfd, floor((strlen($data) - $offset) / self::TIF_IFD_ENTRY_SIZE));

        // Filter through IFD
        for ($i = 0; $i < $sizeIfd; $i++) {
            // Get IFD tag
            $type = unpack($this->typeShort, substr($data, $offset, self::SHORT_SIZE));

            // Get field type of tag
            $fieldType = unpack($this->typeShort . 'type', substr($data, $offset + self::SHORT_SIZE, self::SHORT_SIZE));

            // Get IFD entry
            $ifdValue = substr($data, $offset + 2 * self::LONG_SIZE, self::LONG_SIZE);

            // Set size of field
            $this->setSizeInfo($type[1], $fieldType['type'], $ifdValue);

            $offset += self::TIF_IFD_ENTRY_SIZE;
        }

        return $this->size;
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Sets byte type based on signature in header.
     *
     * @param string $signature Header signature
     */
    private function setByteType(string $signature)
    {
        if ($signature === self::TIF_SIGNATURE_INTEL) {
            $this->typeLong = 'V';
            $this->typeShort = 'v';
            $this->size['type'] = IMAGETYPE_TIFF_II;
        } else {
            $this->typeLong = 'N';
            $this->typeShort = 'n';
            $this->size['type'] = IMAGETYPE_TIFF_MM;
        }
    }

    /**
     * Sets size info.
     *
     * @param int $dimensionType Type of dimension. Either width or height
     * @param int $fieldLength Length of field. Either short or long
     * @param string $ifdValue String value of IFD field
     */
    private function setSizeInfo(int $dimensionType, int $fieldLength, string $ifdValue)
    {
        // Set size of field
        $fieldSize = $fieldLength === self::TIF_TAG_TYPE_SHORT ? $this->typeShort : $this->typeLong;

        // Get actual dimensions from IFD
        if ($dimensionType === self::TIF_TAG_IMAGE_HEIGHT) {
            $this->size = array_merge($this->size, unpack($fieldSize . 'height', $ifdValue));
        } else if ($dimensionType === self::TIF_TAG_IMAGE_WIDTH) {
            $this->size = array_merge($this->size, unpack($fieldSize . 'width', $ifdValue));
        }
    }
}
