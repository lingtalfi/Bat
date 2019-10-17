<?php

namespace Ling\Bat;


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
        } else {
            $ext = strtolower(FileSystemTool::getFileExtension($file));
            $mime = self::getMimeTypeByFileExtension($ext);
        }
        return $mime;
    }

    /**
     * Returns the mime type associated with the given file extension, or returns the given default extension otherwise.
     * if the default extension is not provided, it defaults to "application/octet-stream".
     *
     * If the extension has no corresponding mime-type, the found flag is set to false.
     * This is a mechanism to help the developer be aware of that miss and potentially keep this method updated.
     *
     *
     *
     * @param string $extension
     * @param string|null $default
     * @param bool $found
     * @return string
     */
    public static function getMimeTypeByFileExtension(string $extension, string $default = null, bool &$found = true): string
    {
        switch ($extension) {
            case "ai":
                return "application/postscript";
            case "bmp":
                return "image/bmp";
            case "cab":
                return "application/vnd.ms-cab-compressed";
            case "css":
                return "text/css";
            case "doc":
                return "application/msword";
            case "eps":
                return "application/postscript";
            case "exe":
                return "application/x-msdownload";
            case "flv":
                return "video/x-flv";
            case "gif":
                return "image/gif";
            case "htm":
            case "html":
                return "text/html";
            case "ico":
                return "image/vnd.microsoft.icon";
            case "js":
                return "application/javascript";
            case "json":
                return "application/json";
            case "jpe":
            case "jpeg":
            case "jpg":
                return "image/jpeg";
            case "mov":
                return "video/quicktime";
            case "mp3":
                return "audio/mpeg";
            case "msi":
                return "application/x-msdownload";
            case "ods":
                return "application/vnd.oasis.opendocument.spreadsheet";
            case "odt":
                return "application/vnd.oasis.opendocument.text";
            case "pdf":
                return "application/pdf";
            case "php":
                return "application/x-httpd-php";
            case "png":
                return "image/png";
            case "ppt":
                return "application/vnd.ms-powerpoint";
            case "ps":
                return "application/postscript";
            case "psd":
                return "image/vnd.adobe.photoshop";
            case "qt":
                return "video/quicktime";
            case "rar":
                return "application/x-rar-compressed";
            case "rtf":
                return "application/rtf";
            case "svg":
            case "svgz":
                return "image/svg+xml";
            case "swf":
                return "application/x-shockwave-flash";
            case "tif":
            case "tiff":
                return "image/tiff";
            case "txt":
                return "text/plain";
            case "xls":
                return "application/vnd.ms-excel";
            case "xlsx":
                return "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
            case "xml":
                return "application/xml";
            case "zip":
                return "application/zip";
            default:
                $found = false;
                if (null !== $default) {
                    return $default;
                }
                return "application/octet-stream";
                break;
        }
    }
}
