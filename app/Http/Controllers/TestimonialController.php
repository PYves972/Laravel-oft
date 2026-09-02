<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        // Récupère tous les témoignages publiés, du plus récent au plus ancien
        $testimonials = Testimonial::where('is_published', true)
            ->latest()
            ->get();

        return view('testimonials', compact('testimonials'));
    }
}
