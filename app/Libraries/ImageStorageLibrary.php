<?php

namespace App\Libraries;

use App\Libraries\MimeChecker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ImageStorageLibrary
{
    public static function storeImage($imageFile, $title)
    {
        $imageName = uniqid() . '_' . time() . '.' . $imageFile->getClientOriginalExtension();

        $imagePath = $imageFile->storeAs('public/uploads/' . $title, $imageName);

        return $imagePath;
    }

    public static function processAndSaveImagesInContentCreate($content, $directoryParent, $name)
    {
        $blogContent = $content;
        preg_match_all('/<img[^>]+src="([^"]+)"/', $blogContent, $matches);
        $imagePaths = $matches[1];
        foreach ($imagePaths as $imagePath) {
            $newImagePath = self::storeImageContent($imagePath, $directoryParent, $name, 'content');
            // Lấy tên tệp hình ảnh từ đường dẫn
            $imageName = basename($newImagePath);
            // Thay thế đường dẫn bằng tên tệp hình ảnh
            $blogContent = str_replace($imagePath, $imageName, $blogContent);
        }
        return $blogContent;
    }

    public static function processAndSaveImagesInContentUpdate($content, $directoryParent, $name)
    {
        //tạo folder chứa ảnh mới tạm thời
        self::createDirectoryContent2($directoryParent,$name);
        //xử lý bài viết và lưu ảnh
        $processedContent = $content;
        preg_match_all('/<img[^>]+src="([^"]+)"/', $processedContent, $matches);
        foreach ($matches[1] as $key => $path) {
            $basename = basename($path);
            $oldPath = public_path("storage/uploads/$directoryParent/$name/content/$basename");
            if (File::exists($oldPath)) {
                $newPath = public_path("storage/uploads/$directoryParent/$name/content2/$basename");
                //copy ảnh sang thư mục tạm thời
                File::copy($oldPath, $newPath);
                //thay thế đường dẫn bằng tên hình ảnh
                $processedContent = str_replace($path, $basename, $processedContent);
                unset($matches[1][$key]);
            } else {
                //lưu ảnh mới có trong content
                $pathNewImage =  self::storeImageContent($path, $directoryParent, $name, 'content2');
                $imageName = pathinfo($pathNewImage, PATHINFO_BASENAME);
                //thay thế đường dẫn bằng tên hình ảnh
                $processedContent = str_replace($path, $imageName, $processedContent);
            }
        }
        //đổi tên thư mục tạm thời thành content
        self::changeNameFolderContent($directoryParent,$name);
        return $processedContent;
    }

    private static function storeImageContent($imagePath, $directoryParent, $title, $directory)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagePath));
        $imageName = time() . '_' . Str::random(10) . '.png';
        Storage::disk('public')->put("uploads/$directoryParent/" . $title . "/$directory/" . $imageName, $imageData);
        return asset('storage/uploads/products/' . $imageName);
    }

    public static function updateUrlContent($content, $directoryParent, $name)
    {
        preg_match_all('/<img[^>]+src="([^"]+)"/', $content, $matches);
        foreach ($matches[1] as $img) {
            $content = str_replace($img, url("storage/uploads/$directoryParent/$name/content/$img"), $content);
        }
        return $content;
    }

    public static function updateNameFolder($directoryParent, $oldName, $newName)
    {
        //lấy tên thư mục cũ
        $oldPathTitle = public_path("storage/uploads/$directoryParent/$oldName");
        $newPathTitle = public_path("storage/uploads/$directoryParent/$newName");
        if (File::isDirectory($oldPathTitle)) {
            File::move($oldPathTitle, $newPathTitle);
        }
    }

    public static function processImageUpdate($newPath, $directoryParent, $name, $directory, $oldImageName)
    {
        $oldThumbNail = public_path("storage/uploads/$directoryParent/$name/$directory/$oldImageName");
        if (File::exists($oldThumbNail)) {
            unlink($oldThumbNail);
        }
        $newThumbPath = self::storeImage($newPath, "$directoryParent/$name/$directory");
        return $newThumbPath;
    }

    public static function deleteFolder($directoryFolder)
    {
        if (File::isDirectory($directoryFolder)) return File::deleteDirectory($directoryFolder);
        return false;
    }

    private static function changeNameFolderContent($directoryParent, $name)
    {
        //xoá thư mục content cũ
        if (File::isDirectory(public_path("storage/uploads/$directoryParent/$name/content"))) {
            File::deleteDirectory(public_path("storage/uploads/$directoryParent/$name/content"));
        }
        //đổi tên thư mục tạm thời content2 thành content
        if (File::isDirectory(public_path("storage/uploads/$directoryParent/$name/content2"))) {
            File::move(public_path("storage/uploads/$directoryParent/$name/content2"), public_path("storage/uploads/$directoryParent/$name/content"));
        };
    }

    private static function createDirectoryContent2($directoryParent, $name)
    {
        if (!File::isDirectory(public_path("storage/uploads/$directoryParent/$name/content2"))) {
            File::makeDirectory(public_path("storage/uploads/$directoryParent/$name/content2"), 0755, true);
        }
    }
   
}
