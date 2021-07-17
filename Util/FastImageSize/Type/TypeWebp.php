<?php


namespace Ling\Bat\Util\FastImageSize\Type;


use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 * The TypeWebp class.
 */
class TypeWebp extends TypeBase
{
    /**
     * @var string RIFF header
     */
    public const WEBP_RIFF_HEADER = "RIFF";

    /**
     * @var string Webp header
     */
    public const WEBP_HEADER = "WEBP";

    /**
     * @var string VP8 chunk header
     */
    public const VP8_HEADER = "VP8";

    /**
     * @var string Simple(lossy) webp format
     */
    public const WEBP_FORMAT_SIMPLE = ' ';

    /**
     * @var string Lossless webp format
     */
    public const WEBP_FORMAT_LOSSLESS = 'L';

    /**
     * @var string Extended webp format
     */
    public const WEBP_FORMAT_EXTENDED = 'X';

    /**
     * @var int WEBP header size needed for retrieving image size
     */
    public const WEBP_HEADER_SIZE = 30;

    /** @var array Size info array */
    private array $size;

    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        // Do not force length of header
        $data = FastImageSizeHelper::getImageData($filename, 0, self::WEBP_HEADER_SIZE);
        if (false === $data) {
            return false;
        }

        $this->size = [];

        $webpFormat = substr($data, 15, 1);

        if (!$this->hasWebpHeader($data) || !$this->isValidFormat($webpFormat)) {
            return false;
        }

        $data = substr($data, 16, 14);

        $this->prepareWebpSize($data, $webpFormat);

        return $this->size;
    }

    
    //--------------------------------------------
    // 
    //--------------------------------------------
    /**
     * Returns whether $data has valid WebP header.
     *
     * @param string $data Image data
     *
     * @return bool True if $data has valid WebP header, false if not
     */
    private function hasWebpHeader(string $data): bool
    {
        $riffSignature = substr($data, 0, self::LONG_SIZE);
        $webpSignature = substr($data, 8, self::LONG_SIZE);
        $vp8Signature = substr($data, 12, self::SHORT_SIZE + 1);

        return !empty($data) && $riffSignature === self::WEBP_RIFF_HEADER &&
            $webpSignature === self::WEBP_HEADER && $vp8Signature === self::VP8_HEADER;
    }

    /**
     * Returns whether $format is a valid WebP format.
     *
     * @param string $format Format string
     * @return bool True if format is valid WebP format, false if not
     */
    private function isValidFormat(string $format): bool
    {
        return in_array($format, [self::WEBP_FORMAT_SIMPLE, self::WEBP_FORMAT_LOSSLESS, self::WEBP_FORMAT_EXTENDED]);
    }

    /**
     * Sets the webp size info depending on format type.
     *
     * @param string $data Data string
     * @param string $format Format string
     */
    private function prepareWebpSize(string $data, string $format)
    {
        switch ($format) {
            case self::WEBP_FORMAT_SIMPLE:
                $this->size = unpack('vwidth/vheight', substr($data, 10, 4));
                break;

            case self::WEBP_FORMAT_LOSSLESS:
                // Lossless uses 14-bit values so we'll have to use bitwise shifting
                $this->size = [
                    'width' => ord($data[5]) + ((ord($data[6]) & 0x3F) << 8) + 1,
                    'height' => (ord($data[6]) >> 6) + (ord($data[7]) << 2) + ((ord($data[8]) & 0xF) << 10) + 1,
                ];
                break;

            case self::WEBP_FORMAT_EXTENDED:
                // Extended uses 24-bit values cause 14-bit for lossless wasn't weird enough
                $this->size = [
                    'width' => ord($data[8]) + (ord($data[9]) << 8) + (ord($data[10]) << 16) + 1,
                    'height' => ord($data[11]) + (ord($data[12]) << 8) + (ord($data[13]) << 16) + 1,
                ];
                break;
        }
    }
}
