<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryPath = public_path('images/galerie');
        $images = [];

        if (File::exists($galleryPath)) {
            $files = File::files($galleryPath);

            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif'])) {
                    $images[] = 'images/galerie/' . $file->getFilename();
                }
            }
        }

        return view('gallery', compact('images'));
    }
}
