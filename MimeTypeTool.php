<?php

namespace Bat;


/**
 * MimeTypeTool
 * @author Lingtalfi
 * 2015-10-25
 *
 */
class MimeTypeTool
{

    public static function getMimeType($file)
    {
        $mime = 'application/octet-stream';

        if (
            extension_loaded('fileinfo') &&
            'http://' !== substr($file, 0, 7) &&
            'https://' !== substr($file, 0, 8)
        ) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            if (false !== ($_mime = finfo_file($finfo, $file))) {
                $mime = $_mime;
            }
            finfo_close($finfo);
        }
        else {
            $ext = strtolower(FileSystemTool::getFileExtension($file));
            $ext2Mime = array(

                'txt' => 'text/plain',
                'htm' => 'text/html',
                'html' => 'text/html',
                'php' => 'text/html',
                'css' => 'text/css',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'xml' => 'application/xml',
                'swf' => 'application/x-shockwave-flash',
                'flv' => 'video/x-flv',

                // images
                'png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                'ico' => 'image/vnd.microsoft.icon',
                'tiff' => 'image/tiff',
                'tif' => 'image/tiff',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',

                // archives
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'exe' => 'application/x-msdownload',
                'msi' => 'application/x-msdownload',
                'cab' => 'application/vnd.ms-cab-compressed',

                // audio/video
                'mp3' => 'audio/mpeg',
                'qt' => 'video/quicktime',
                'mov' => 'video/quicktime',

                // adobe
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript',

                // ms office
                'doc' => 'application/msword',
                'rtf' => 'application/rtf',
                'xls' => 'application/vnd.ms-excel',
                'ppt' => 'application/vnd.ms-powerpoint',

                // open office
                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
            if (array_key_exists($ext, $ext2Mime)) {
                $mime = $ext2Mime[$ext];
            }

        }
        return $mime;
    }
}
