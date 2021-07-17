<?php


namespace Ling\Bat\Util\FastImageSize\Type;


use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 * The TypeJpeg class.
 *
 */
class TypeJpeg extends TypeBase
{
    /** @var int JPEG max header size. Headers can be bigger, but we'll abort
     *            going through the header after this
     */
    public const JPEG_MAX_HEADER_SIZE = 786432; // = 768 kiB

    /**
     * @var string JPEG header
     */
    public const JPEG_HEADER = "\xFF\xD8";

    /**
     * @var string Start of frame marker
     */
    public const SOF_START_MARKER = "\xFF";

    /**
     * @var string End of image (EOI) marker
     */
    public const JPEG_EOI_MARKER = "\xD9";

    /**
     * @var array JPEG SOF markers
     */
    private array $sofMarkers;

    /**
     * JPEG data stream.
     * @var string|false
     */
    private string|false $data;

    /**
     * This property holds the dataLength for this instance.
     * @var int
     */
    private int $dataLength;


    /**
     * Builds the TypeJpeg instance.
     */
    public function __construct()
    {
        $this->data = '';
        $this->dataLength = 0;
        $this->sofMarkers = [
            "\xC0",
            "\xC1",
            "\xC2",
            "\xC3",
            "\xC5",
            "\xC6",
            "\xC7",
            "\xC9",
            "\xCA",
            "\xCB",
            "\xCD",
            "\xCE",
            "\xCF"
        ];
    }



    //--------------------------------------------
    // TypeInterface
    //--------------------------------------------
    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        // Do not force the data length
        $this->data = FastImageSizeHelper::getImageData($filename, 0, self::JPEG_MAX_HEADER_SIZE, false);

        // Check if file is jpeg
        if ($this->data === false || substr($this->data, 0, self::SHORT_SIZE) !== self::JPEG_HEADER) {
            return false;
        }

        // Look through file for SOF marker
        return $this->getSizeInfo();
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Get size info from image data, or false if info not found.
     *
     * @return array|false
     */
    protected function getSizeInfo(): array|false
    {
        $size = [];
        // since we check $i + 1 we need to stop one step earlier
        $this->dataLength = strlen($this->data) - 1;

        $sofStartRead = true;

        // Look through file for SOF marker
        for ($i = 2; $i < $this->dataLength; $i++) {
            $marker = $this->getNextMarker($i, $sofStartRead);

            if (in_array($marker, $this->sofMarkers)) {
                // Extract size info from SOF marker
                return $this->extractSizeInfo($i);
            } else {
                // Extract length only
                $markerLength = $this->extractMarkerLength($i);

                if ($markerLength < 2) {
                    return false;
                }

                $i += $markerLength - 1;
            }
        }

        return false;
    }

    /**
     * Returns marker length from data.
     *
     * @param int $i Current index
     * @return int Length of current marker
     */
    protected function extractMarkerLength(int $i): int
    {
        // Extract length only
        list(, $unpacked) = unpack("H*", substr($this->data, $i, self::LONG_SIZE));

        // Get width and height from unpacked size info
        return hexdec(substr($unpacked, 0, 4));
    }

    /**
     * Returns size info from data.
     *
     * @param int $i Current index
     * @return array Size info of current marker
     */
    protected function extractSizeInfo(int $i): array
    {
        // Extract size info from SOF marker
        list(, $unpacked) = unpack("H*", substr($this->data, $i - 1 + self::LONG_SIZE, self::LONG_SIZE));

        // Get width and height from unpacked size info
        $size = [
            'width' => hexdec(substr($unpacked, 4, 4)),
            'height' => hexdec(substr($unpacked, 0, 4)),
        ];

        return $size;
    }

    /**
     * Returns next JPEG marker in file, and moves the given index accordingly.
     *
     * @param int $i Current index
     * @param bool $sofStartRead Flag whether SOF start padding was already read
     *
     * @return string Next JPEG marker in file
     */
    protected function getNextMarker(int &$i, bool &$sofStartRead): string
    {
        $this->skipStartPadding($i, $sofStartRead);

        do {
            if ($i >= $this->dataLength) {
                return self::JPEG_EOI_MARKER;
            }
            $marker = $this->data[$i];
            $i++;
        } while ($marker == self::SOF_START_MARKER);

        return $marker;
    }

    /**
     * Skip over any possible padding until we reach a byte without SOF start
     * marker. Extraneous bytes might need to require proper treating.
     *
     * @param int $i Current index
     * @param bool $sofStartRead Flag whether SOF start padding was already read
     */
    protected function skipStartPadding(int &$i, bool &$sofStartRead)
    {
        if (!$sofStartRead) {
            while ($this->data[$i] !== self::SOF_START_MARKER) {
                $i++;
            }
        }
    }
}
