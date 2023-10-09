<?php
namespace App\Libraries;

class MimeChecker
{
    public static function isImage($file)
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 3 * 1024 * 1024; // 3MB

        $fileMimeType = mime_content_type($file);
        $fileSize = filesize($file);

        return in_array($fileMimeType, $allowedMimeTypes) && $fileSize <= $maxSize;
    }
}
