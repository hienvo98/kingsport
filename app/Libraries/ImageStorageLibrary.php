<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Storage;

class ImageStorageLibrary
{
    public static function storeImage($imageFile, $title)
    {
        $imageName = uniqid() . '_' . time() . '.' . $imageFile->getClientOriginalExtension();

        $imagePath = $imageFile->storeAs('public/uploads/' . $title, $imageName);

        return $imagePath;
    }
}
