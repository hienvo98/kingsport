<?php

namespace App\Libraries;

use App\Libraries\MimeChecker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageStorageLibrary
{
    public static function storeImage($imageFile, $title)
    {
        $imageName = uniqid() . '_' . time() . '.' . $imageFile->getClientOriginalExtension();

        $imagePath = $imageFile->storeAs('public/uploads/' . $title, $imageName);

        return $imagePath;
    }

    public static function processAndSaveImagesInContent($content,$directoryParent ,$name)
    {
        $blogContent = $content;
        preg_match_all('/<img[^>]+src="([^"]+)"/', $blogContent, $matches);
        $imagePaths = $matches[1];
        foreach ($imagePaths as $imagePath) {
            $newImagePath = self::storeImageContent($imagePath,$directoryParent,$name, 'content');
            // Lấy tên tệp hình ảnh từ đường dẫn
            $imageName = basename($newImagePath);
            // Thay thế đường dẫn bằng tên tệp hình ảnh
            $blogContent = str_replace($imagePath, $imageName, $blogContent);
        }
        return $blogContent;
    }

    public static function storeImageContent($imagePath,$directoryParent, $title, $directory)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagePath));
        $imageName = time() . '_' . Str::random(10) . '.png';
        Storage::disk('public')->put("uploads/$directoryParent/" . $title . "/$directory/" . $imageName, $imageData);
        return asset('storage/uploads/products/' . $imageName);
    }

    public static function updateUrlContent($content,$directoryParent,$name){
        preg_match_all('/<img[^>]+src="([^"]+)"/',$content, $matches);
        foreach ($matches[1] as $img) {
           $content = str_replace($img, url("storage/uploads/$directoryParent/$name/content/$img"),$content);
        }
        return $content;
    }
}
