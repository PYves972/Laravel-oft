<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function home()
    {
        // Récupération des témoignages
        $testimonials = Testimonial::all();

        // Récupération dynamique du premier cours et atelier
        $featuredFormation = Training::first();
        $featuredWorkshop  = Training::skip(1)->first();

        return view('home', compact('testimonials', 'featuredFormation', 'featuredWorkshop'));
    }
}
