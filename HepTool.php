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
     * @param string|null $prefix
     * @return string
     */
    public static function hepAttributes(array $params, string $prefix = null): string
    {
        $s = '';
        foreach ($params as $k => $v) {
            if (is_array($v)) {
                $s .= self::hepAttributes($v, $k);
            } else {
                if (null !== $prefix) {
                    $k = $prefix . '-' . $k;
                }
                $s .= ' data-param-' . $k . '="' . htmlspecialchars($v) . '"';
            }
        }
        return $s;
    }
}