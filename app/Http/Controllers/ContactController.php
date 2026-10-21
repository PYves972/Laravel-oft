<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ContactController extends Controller
{
    /**
     * Enregistre le message du formulaire de contact.
     */
    public function store(Request $request)
    {
        // 1. Validation des données envoyées par le formulaire
        $validated = $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'nullable|string|max:255',
            'email'     => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'sujet'     => 'required|string|max:255',
            'niveau'    => 'nullable|string|max:50',
            'fichier'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'message'   => 'required|string|max:5000',
            'rgpd'      => 'accepted',
        ], [
            'rgpd.accepted' => 'Vous devez accepter que vos données soient utilisées pour traiter votre demande.',
        ]);

        // 2. Pièce jointe éventuelle : disque privé, sans URL publique
        $pathFichier = null;
        if ($request->hasFile('fichier')) {
            $pathFichier = $request->file('fichier')->store('contacts', 'local');
        }

        // 3. Enregistrement en base (le consentement est contrôlé mais pas stocké)
        ContactMessage::create(array_merge(
            Arr::except($validated, ['fichier', 'rgpd']),
            ['fichier_path' => $pathFichier]
        ));

        return redirect()->back()->with('success', 'Votre message a bien été envoyé ! Nous vous répondrons dans les plus brefs délais.');
    }
}
