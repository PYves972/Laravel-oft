<?php

use App\Livewire\ShowAtelier;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Training;
use App\Models\TrainingSession;
use App\Models\User;
use App\Services\BookingService;
use Livewire\Livewire;

/*
 * Tests des règles de réservation (ShowAtelier + BookingService).
 * Les données sont créées à la main car seule UserFactory existe dans le projet.
 */

function makeTraining(string $slug = 'atelier-test'): Training
{
    $category = Category::unguarded(fn () => Category::firstOrCreate(
        ['slug' => 'couture'],
        ['name' => 'Couture']
    ));

    return Training::unguarded(fn () => Training::create([
        'category_id' => $category->id,
        'title' => 'Atelier ' . $slug,
        'slug' => $slug,
        'description' => 'Description de test',
        'duration_minutes' => 120,
        'price' => 45,
        'is_active' => true,
        'type' => 'atelier',
    ]));
}

function makeSession(Training $training, int $capacity = 7): TrainingSession
{
    return TrainingSession::create([
        'training_id' => $training->id,
        'starts_at' => now()->addDays(3)->setTime(11, 0),
        'ends_at' => now()->addDays(3)->setTime(13, 0),
        'capacity' => $capacity,
        'status' => 'open',
    ]);
}

function atelier(Training $training, int $sessionId)
{
    return Livewire::test(ShowAtelier::class, ['slug' => $training->slug])
        ->set('selectedSessionId', $sessionId);
}

test('un visiteur non connecté est redirigé vers la connexion', function () {
    $training = makeTraining();
    $session = makeSession($training);

    atelier($training, $session->id)
        ->call('addToCart')
        ->assertRedirect(route('login'));

    expect(Booking::count())->toBe(0);
});

test('un membre connecté peut réserver une séance libre', function () {
    $training = makeTraining();
    $session = makeSession($training, 7);
    $this->actingAs(User::factory()->create());

    atelier($training, $session->id)
        ->call('addToCart')
        ->assertSee('Votre réservation a été confirmée avec succès !');

    expect(Booking::count())->toBe(1);
    expect(Booking::first()->status)->toBe('confirmed');
    expect($session->fresh()->placesLeft())->toBe(6);
});

test('une double réservation de la même séance est refusée', function () {
    $training = makeTraining();
    $session = makeSession($training);
    $this->actingAs(User::factory()->create());

    atelier($training, $session->id)->call('addToCart');
    atelier($training, $session->id)
        ->call('addToCart')
        ->assertSee('Vous avez déjà réservé cette séance.');

    expect(Booking::count())->toBe(1);
});

test('une séance dont la capacité est atteinte refuse une nouvelle réservation', function () {
    $training = makeTraining();
    $session = makeSession($training, 1);

    // Réservation insérée directement : la séance reste « open » mais n'a plus de place
    Booking::create([
        'user_id' => User::factory()->create()->id,
        'training_session_id' => $session->id,
        'status' => 'confirmed',
    ]);

    $this->actingAs(User::factory()->create());
    atelier($training, $session->id)
        ->call('addToCart')
        ->assertSee('Cette séance est complète.');

    expect(Booking::count())->toBe(1);
});

test('la dernière place prise passe la séance à complète', function () {
    $training = makeTraining();
    $session = makeSession($training, 1);

    app(BookingService::class)->book(User::factory()->create(), $session->id);

    expect($session->fresh()->status)->toBe('full');
    expect($session->fresh()->placesLeft())->toBe(0);
});

test('une séance d’un autre atelier est refusée', function () {
    $training = makeTraining('atelier-a');
    $autre = makeTraining('atelier-b');
    $sessionAutre = makeSession($autre);

    $this->actingAs(User::factory()->create());
    atelier($training, $sessionAutre->id)
        ->call('addToCart')
        ->assertSee('Cette séance ne correspond pas à cet atelier.');

    expect(Booking::count())->toBe(0);
});
