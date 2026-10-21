<?php

use App\Models\ContactMessage;

test('un visiteur peut envoyer un message de contact', function () {
    $this->post(route('contact.store'), [
        'nom' => 'Dupont',
        'email' => 'visiteur@example.com',
        'sujet' => 'Question sur un atelier',
        'message' => 'Bonjour, je voudrais des informations.',
    ])->assertRedirect();

    expect(ContactMessage::count())->toBe(1);
    expect(ContactMessage::first()->email)->toBe('visiteur@example.com');
    expect(ContactMessage::first()->read_at)->toBeNull();
});

test('un message avec un email invalide est refusé', function () {
    $this->post(route('contact.store'), [
        'nom' => 'Dupont',
        'email' => 'pas-un-email',
        'sujet' => 'Question',
        'message' => 'Bonjour',
    ])->assertSessionHasErrors('email');

    expect(ContactMessage::count())->toBe(0);
});

test('un message sans contenu est refusé', function () {
    $this->post(route('contact.store'), [
        'nom' => 'Dupont',
        'email' => 'visiteur@example.com',
        'sujet' => 'Question',
    ])->assertSessionHasErrors('message');

    expect(ContactMessage::count())->toBe(0);
});
