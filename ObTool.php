<?php


namespace Bat;


class ObTool
{

    public static function cleanAll($returnContent = false)
    {
        if (false === $returnContent) {
            while (ob_get_level()) {
                ob_get_clean();
            }
        } else {
            $s = "";
            while (ob_get_level()) {
                $s .= ob_get_clean();
            }
            return $s;
        }
    }
}