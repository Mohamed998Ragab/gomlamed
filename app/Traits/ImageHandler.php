<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ImageHandler
{
    private function saveImage($image)
    {
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('admin/images'), $imageName);
        return 'admin/images/' . $imageName;
    }

    private function deleteImage($imagePath)
    {
        $fullPath = public_path($imagePath);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}
