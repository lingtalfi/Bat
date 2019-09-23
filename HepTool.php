<?php


namespace Ling\Bat;


/**
 * The HepTool class.
 *
 * More info about hep: https://github.com/lingtalfi/NotationFan/blob/master/html-element-parameters.md
 *
 */
class HepTool
{

    /**
     * Returns the (html) string corresponding to the hep attributes.
     *
     *
     *
     * @param array $params
     * @return string
     */
    public static function hepAttributes(array $params): string
    {
        $s = '';
        foreach ($params as $k => $v) {
            $s .= ' data-param-' . $k . '="' . htmlspecialchars($v) . '"';
        }
        return $s;
    }
}