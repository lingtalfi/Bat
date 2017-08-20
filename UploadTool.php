<?php


namespace Bat;


class UploadTool
{


    /**
     * @param array $phpFile
     *   - name
     *   - tmp_name
     *   - error
     *   - type
     *   - size
     * @return bool
     */
    public static function isValid(array $phpFile)
    {
        if (
            array_key_exists('error', $phpFile) &&
            0 === (int)$phpFile['error'] &&
            array_key_exists('name', $phpFile) &&
            array_key_exists('tmp_name', $phpFile) &&
            array_key_exists('size', $phpFile) &&
            array_key_exists('type', $phpFile)
        ) {
            return true;
        }
        return false;
    }

}