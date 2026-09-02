<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryPath = public_path('images/galerie');
        $images = [];

        if (File::exists($galleryPath)) {
            // Récupérer tous les fichiers du dossier
            $files = File::files($galleryPath);

            foreach ($files as $file) {
                // Filtrer par extensions d'images autorisées
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                    $images[] = 'images/galerie/' . $file->getFilename();
                }
            }
        }

        return view('gallery', compact('images'));
    }
}
