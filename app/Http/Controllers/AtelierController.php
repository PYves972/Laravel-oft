<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Import du modèle Event

class AtelierController extends Controller
{
    public function show()
    {
        return view('atelier.about');
    }

    public function index()
    {
        // Récupère le dernier événement actif dont la date d'événement n'est pas encore passée
        $annonce = Event::where('is_active', true)
                        ->where(function($query) {
                            $query->whereNull('event_date')
                                  ->orWhere('event_date', '>=', now());
                        })
                        ->latest()
                        ->first();

        return view('welcome', compact('annonce'));
    }
}
