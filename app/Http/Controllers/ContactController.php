<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'nom'     => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Redirection avec message de confirmation
        return back()->with('success', 'Votre message a bien été envoyé ! Nous vous répondrons dans les plus brefs délais.');
    }
}
