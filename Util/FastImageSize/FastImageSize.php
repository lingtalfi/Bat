<?php


namespace Ling\Bat\Util\FastImageSize;


/**
 *
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 *
 * The FastImageSize class.
 */
class FastImageSize
{
    /**
     * Size info that is returned.
     * @var array
     */
    protected array $size;


    /**
     * List of supported image types and associated image types.
     * @var array
     */
    protected array $supportedTypes;

    /**
     * Class map that links image extensions/mime types to class.
     * @var array
     */
    protected array $classMap;

    /**
     * An array containing the classes of supported image types.
     * @var array
     */
    protected array $type;


    public function __construct()
    {

        $this->size = [];
        $this->supportedTypes = [
            'png' => ['png'],
            'gif' => ['gif'],
            'jpeg' => [
                'jpeg',
                'jpg',
                'jpe',
                'jif',
                'jfif',
                'jfi',
            ],
            'jp2' => [
                'jp2',
                'j2k',
                'jpf',
                'jpg2',
                'jpx',
                'jpm',
            ],
            'psd' => [
                'psd',
                'photoshop',
            ],
            'bmp' => ['bmp'],
            'tif' => [
                'tif',
                'tiff',
            ],
            'wbmp' => [
                'wbm',
                'wbmp',
                'vnd.wap.wbmp',
            ],
            'iff' => [
                'iff',
                'x-iff',
            ],
            'ico' => [
                'ico',
                'vnd.microsoft.icon',
                'x-icon',
                'icon',
            ],
            'webp' => [
                'webp',
            ]
        ];
        $this->classMap = [];
        $this->type = [];
    }


    /**
     * Returns an array with image dimensions of supplied image if successful, or false otherwise.
     * Type: Mimetype of image.
     *
     *
     * @param string $file
     * @param string $type
     * @return array|false
     */
    public function getImageSize(string $file, string $type = ''): array|false
    {
        // Reset values
        $this->resetValues();

        // Treat image type as unknown if extension or mime type is unknown
        if (!preg_match('/\.([a-z0-9]+)$/i', $file, $match) && empty($type)) {
            return $this->getImageSizeUnknownType($file);
        } else {
            $extension = (empty($type) && isset($match[1])) ? $match[1] : preg_replace('/.+\/([a-z0-9-.]+)$/i', '$1', $type);

            return $this->getImageSizeByExtension($file, $extension);
        }
    }





    //--------------------------------------------
    //
    //--------------------------------------------

    /**
     * Reset values to default.
     */
    private function resetValues()
    {
        $this->size = [];
    }

    /**
     * Returns the dimensions of image which type is unknown.
     *
     * @param string $filename Path to file
     * @return array|false
     */
    private function getImageSizeUnknownType(string $filename): array|false
    {
        // Grab the maximum amount of bytes we might need
        $data = FastImageSizeHelper::getImageData($filename, 0, Type\TypeJpeg::JPEG_MAX_HEADER_SIZE, false);

        if ($data !== false) {
            $this->loadAllTypes();
            foreach ($this->type as $imageType) {
                $size = $imageType->getSize($filename);

                if (false !== $size) {
                    return $size;
                }
            }
        }
        return false;
    }


    /**
     * Get image size by file extension.
     *
     * @param string $file Path to image that should be checked
     * @param string $extension Extension/type of image
     * @return array|false
     */
    private function getImageSizeByExtension(string $file, string $extension): array|false
    {
        $extension = strtolower($extension);
        $this->loadExtension($extension);
        if (isset($this->classMap[$extension])) {
            return $this->classMap[$extension]->getSize($file);
        }
        return false;
    }


    /**
     * Load all supported types.
     */
    private function loadAllTypes()
    {
        foreach ($this->supportedTypes as $imageType => $extension) {
            $this->loadType($imageType);
        }
    }

    /**
     * Load an image type.
     *
     * @param string $imageType Mimetype
     */
    private function loadType(string $imageType)
    {
        if (isset($this->type[$imageType])) {
            return;
        }

        $className = '\Ling\Bat\Util\FastImageSize\Type\Type' . mb_convert_case(mb_strtolower($imageType), MB_CASE_TITLE);
        $this->type[$imageType] = new $className();

        // Create class map
        foreach ($this->supportedTypes[$imageType] as $ext) {
            $this->classMap[$ext] = $this->type[$imageType];
        }
    }


    /**
     * Load an image type by extension.
     *
     * @param string $extension Extension of image
     */
    private function loadExtension($extension)
    {
        if (true === isset($this->classMap[$extension])) {
            return;
        }
        foreach ($this->supportedTypes as $imageType => $extensions) {
            if (true === in_array($extension, $extensions, true)) {
                $this->loadType($imageType);
            }
        }
    }


}



