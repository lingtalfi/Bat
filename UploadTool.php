<?php


namespace Ling\Bat;

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
 *
 *
 * combinedStructure
 * -------------------
 * array:
 *      - name: array of php file names
 *      - type: array of php file mime types
 *      - tmp_name: array of php file temporary locations
 *      - error: array of php file error indicators
 *      - size: array of php file sizes
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


    /**
     *
     *
     * @param array $phpFilesItem ,  a regular $_FILES item,
     *              which can have one of two structure:
     *                  - single file upload (a phpFile item as described at the top of this class)
     *                  - multiple file upload ( a combined structure as described at the top of this class)
     *
     * @return array|false an array of phpFile items (as described at the top of this class).
     *                  false is returned if the given array is empty
     */
    public static function getPhpFilesArrayFromFilesSuperArrayItem(array $phpFilesItem)
    {
        if ($phpFilesItem) {
            foreach ($phpFilesItem as $key => $values) {
                if (is_array($values)) {
                    // this is a combined structure
                    return self::getPhpFilesArrayFromCombinedStructure($phpFilesItem);
                } else {
                    // this is single file structure
                    return [$phpFilesItem];
                }
            }
        }
        return false;
    }
}