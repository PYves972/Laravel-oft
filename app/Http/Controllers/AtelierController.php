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

    /**
     * Gère l'enregistrement d'une image et l'envoie sur Cloudflare R2.
     */
    public function store(Request $request)
    {
        // 1. Valider que le fichier envoyé est bien une image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Envoyer le fichier sur Cloudflare R2 en spécifiant le disque 'r2'
        $path = $request->file('image')->store('images', 'r2');

        // 3. (Optionnel) Enregistrer le chemin ou l'associer dans votre base de données
        // Event::create([
        //     'image_path' => $path,
        //     // ... autres champs
        // ]);

        return back()->with('success', 'Image uploadée et stockée sur Cloudflare R2 avec succès !');
    }
}
