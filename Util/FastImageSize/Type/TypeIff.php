<?php


namespace Ling\Bat\Util\FastImageSize\Type;


use Ling\Bat\Util\FastImageSize\FastImageSizeHelper;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 * The TypeIff class.
 */
class TypeIff extends TypeBase
{
    /**
     * @var int IFF header size. Grab more than what should be needed to make
     * sure we have the necessary data
     */
    public const IFF_HEADER_SIZE = 32;

    /**
     * @var string IFF header for Amiga type
     */
    public const IFF_HEADER_AMIGA = 'FORM';

    /**
     * @var string IFF header for Maya type
     */
    public const IFF_HEADER_MAYA = 'FOR4';

    /**
     * @var string IFF BTMHD for Amiga type
     */
    public const IFF_AMIGA_BTMHD = 'BMHD';

    /**
     * @var string IFF BTMHD for Maya type
     */
    public const IFF_MAYA_BTMHD = 'BHD';

    /**
     * @var string PHP pack format for unsigned short
     */
    public const PACK_UNSIGNED_SHORT = 'n';

    /**
     * @var string PHP pack format for unsigned long
     */
    public const PACK_UNSIGNED_LONG = 'N';


    /**
     * @var string BTMHD of current image
     */
    private string $btmhd;

    /**
     * @var int Size of current BTMHD
     */
    private int $btmhdSize;

    /**
     * @var string Current byte type
     */
    private string $byteType;

    /**
     * {@inheritdoc}
     * @implementation
     */
    public function getSize(string $filename): array|false
    {
        $data = FastImageSizeHelper::getImageData($filename, 0, self::IFF_HEADER_SIZE);
        if (false === $data) {
            return false;
        }

        $signature = $this->getIffSignature($data);

        // Check if image is IFF
        if ($signature === false) {
            return false;
        }

        // Set type constraints
        $this->setTypeConstraints($signature);

        // Get size from data
        $btmhdPosition = strpos($data, $this->btmhd);
        return unpack("{$this->byteType}width/{$this->byteType}height", substr($data, $btmhdPosition + self::LONG_SIZE + strlen($this->btmhd), $this->btmhdSize));
    }

    /**
     * Returns IFF signature from data string.
     *
     * @param string $data Image data string
     *
     * @return false|string Signature if file is a valid IFF file, false if not
     */
    private function getIffSignature(string $data): string|false
    {
        $signature = substr($data, 0, self::LONG_SIZE);

        // Check if image is IFF
        if ($signature !== self::IFF_HEADER_AMIGA && $signature !== self::IFF_HEADER_MAYA) {
            return false;
        } else {
            return $signature;
        }
    }

    /**
     * Sets type constraints for current image.
     *
     * @param string $signature IFF signature of image
     */
    private function setTypeConstraints(string $signature)
    {
        // Amiga version of IFF
        if ($signature === 'FORM') {
            $this->btmhd = self::IFF_AMIGA_BTMHD;
            $this->btmhdSize = self::LONG_SIZE;
            $this->byteType = self::PACK_UNSIGNED_SHORT;
        } // Maya version
        else {
            $this->btmhd = self::IFF_MAYA_BTMHD;
            $this->btmhdSize = self::LONG_SIZE * 2;
            $this->byteType = self::PACK_UNSIGNED_LONG;
        }
    }
}
