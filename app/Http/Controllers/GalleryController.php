<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $services = Service::whereNotNull('image')
            ->latest()
            ->get();

        return view('gallery', compact('services'));
    }
}
