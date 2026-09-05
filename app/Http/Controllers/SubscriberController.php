<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'email.required' => 'Veuillez saisir votre adresse e-mail.',
            'email.email' => 'L\'adresse e-mail n\'est pas valide.',
            'email.unique' => 'Cette adresse e-mail est déjà inscrite à la newsletter.',
        ]);

        Subscriber::create([
            'email' => $validated['email'],
            'subscribed_at' => now(),
        ]);

        return back()->with('newsletter_success', 'Merci pour votre inscription ! Vous recevrez bientôt nos actualités et nouveaux créneaux d\'ateliers.');
    }
}
