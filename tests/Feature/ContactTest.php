<?php

use App\Models\ContactMessage;

function donneesContact(array $surcharge = []): array
{
    return array_merge([
        'nom' => 'Dupont',
        'email' => 'visiteur@example.com',
        'sujet' => 'Question sur un atelier',
        'message' => 'Bonjour, je voudrais des informations.',
        'rgpd' => 'on',
    ], $surcharge);
}

test('un visiteur peut envoyer un message de contact', function () {
    $this->post(route('contact.store'), donneesContact())->assertRedirect();

    expect(ContactMessage::count())->toBe(1);
    expect(ContactMessage::first()->email)->toBe('visiteur@example.com');
    expect(ContactMessage::first()->read_at)->toBeNull();
});

test('un message avec un email invalide est refusé', function () {
    $this->post(route('contact.store'), donneesContact(['email' => 'pas-un-email']))
        ->assertSessionHasErrors('email');

    expect(ContactMessage::count())->toBe(0);
});

test('un message sans contenu est refusé', function () {
    $this->post(route('contact.store'), donneesContact(['message' => '']))
        ->assertSessionHasErrors('message');

    expect(ContactMessage::count())->toBe(0);
});

test('un message sans consentement est refusé', function () {
    $donnees = donneesContact();
    unset($donnees['rgpd']);

    $this->post(route('contact.store'), $donnees)->assertSessionHasErrors('rgpd');

    expect(ContactMessage::count())->toBe(0);
});
