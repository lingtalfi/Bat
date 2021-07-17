<?php


namespace Ling\Bat\Util\FastImageSize\Type;

/**
 * Original project by https://github.com/marc1706/fast-image-size.
 * I modified this utility for my own preferences, but the core is the same.
 * All credits go to the author of the repository.
 *
 * The TypeInterface interface.
 */
interface TypeInterface
{
    /** @var int 4-byte long size */
    const LONG_SIZE = 4;

    /** @var int 2-byte short size */
    const SHORT_SIZE = 2;

    /**
     * Returns the dimensions of the given image (array of width, height, in pixels, both int), or false in case of problem.
     * Throws an exception in case of problem.
     *
     * @param string $filename File name of image
     *
     * @return array|false
     */
    public function getSize(string $filename): array|false;
}
