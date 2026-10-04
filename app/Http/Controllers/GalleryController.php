<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Charger les éléments actifs depuis la BDD au lieu d'un dossier physique local
        $services = Service::whereNotNull('image_path')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('gallery', compact('services'));
    }
}
