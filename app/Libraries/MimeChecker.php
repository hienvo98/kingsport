<?php

namespace App\Libraries;

use Illuminate\Mail\Mailables\Content;

class MimeChecker
{
    public static function ValidateImageInContent($content)
    {
        preg_match_all('/<img[^>]+src="([^"]+)"/', $content, $matches);
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
        $maxSize = 3 * 1024 * 1024; // 3MB
        foreach ($matches[1] as $file) {
            if (str_contains($file, 'data:image/')) {
                $fileMimeType = mime_content_type($file);
                $fileSize = strlen(base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file)));
                if (!(in_array($fileMimeType, $allowedMimeTypes) && $fileSize <= $maxSize)) return false;
            }
        }
        return true;
    }
    // public static function checkImageContent($path){
    //     $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
    //     $maxSize = 3 * 1024 * 1024; // 3MB
    //     $fileMimeType = mime_content_type($file);
    //     $fileSize = filesize($file);
    //     return in_array($fileMimeType, $allowedMimeTypes) && $fileSize <= $maxSize;
    // }
}
