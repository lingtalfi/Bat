<?php


namespace Bat;

/**
 * MODELS
 * ===================
 *
 * phpFile
 * ---------------
 * array:
 *   - name
 *   - tmp_name
 *   - error
 *   - type
 *   - size
 */
class UploadTool
{


    /**
     * @param array $phpFile , a phpFile model (see at the top of this class)
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


    /**
     * @param array $combineStructure :
     *      name: array of php file names
     *      type: array of php file mime types
     *      tmp_name: array of php file temporary locations
     *      error: array of php file error indicators
     *      size: array of php file sizes
     *
     * @return array of phpFile (see top of this class for more info)
     */
    public static function getPhpFilesArrayFromCombinedStructure(array $combineStructure)
    {
        $ret = [];
        foreach ($combineStructure as $key => $values) {
            foreach ($values as $index => $value) {
                $ret[$index][$key] = $value;
            }
        }
        return $ret;
    }
}