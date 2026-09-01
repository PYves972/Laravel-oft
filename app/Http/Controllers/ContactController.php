<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Si vous envoyez un email

class ContactController extends Controller
{
    /**
     * Traitement du formulaire de contact
     */
    public function store(Request $request)
    {
        // 1. VÉRIFICATION DES DONNÉES ENVOYÉES PAR LE FORMULAIRE
        $validatedData = $request->validate([
            'nom'       => 'required|string|max:255',      // Obligatoire, texte
            'prenom'    => 'nullable|string|max:255',      // Optionnel
            'email'     => 'required|email|max:255',       // Obligatoire, format email valide
            'telephone' => 'nullable|string|max:20',       // Optionnel
            'sujet'     => 'required|string|max:255',      // Obligatoire
            'niveau'    => 'nullable|string|max:50',       // Optionnel
            'fichier'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // Optionnel, max 5 Mo
            'message'   => 'required|string',              // Obligatoire
        ]);

        // 2. GESTION DU FICHIER JOIN (SI L'UTILISATEUR EN A JOINT UN)
        $pathFichier = null;
        if ($request->hasFile('fichier')) {
            // Sauvegarde le fichier dans le dossier 'storage/app/public/contacts'
            $pathFichier = $request->file('fichier')->store('contacts', 'public');
        }

        // 3. (OPTIONNEL) TRAITEMENT : ENVOI DE MAIL OU SAUVEGARDE EN BASE
        // Par exemple, si vous enregistrez en base de données :
        // Contact::create(array_merge($validatedData, ['fichier' => $pathFichier]));

        // 4. REDIRECTION VERS LA PAGE D'ACCUEIL AVEC MESSAGE DE SUCCÈS
        return redirect()->back()->with('success', 'Votre message a bien été envoyé ! Nous vous répondrons dans les plus brefs délais.');
    }
}
