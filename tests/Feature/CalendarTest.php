<?php

use App\Livewire\TrainingBookingCalendar;
use App\Models\Category;
use App\Models\Training;
use App\Models\TrainingSession;
use Livewire\Livewire;

function creerAtelierAvecSeance(string $slug, bool $actif): Training
{
    $category = Category::unguarded(fn () => Category::firstOrCreate(['slug' => 'couture'], ['name' => 'Couture']));

    $training = Training::unguarded(fn () => Training::create([
        'category_id' => $category->id,
        'title' => 'Atelier ' . $slug,
        'slug' => $slug,
        'description' => 'Description de test',
        'duration_minutes' => 120,
        'price' => 45,
        'is_active' => $actif,
        'type' => 'atelier',
    ]));

    TrainingSession::create([
        'training_id' => $training->id,
        'starts_at' => now()->addDays(3)->setTime(11, 0),
        'ends_at' => now()->addDays(3)->setTime(13, 0),
        'capacity' => 7,
        'status' => 'open',
    ]);

    return $training;
}

test('le calendrier global affiche un atelier actif et ses séances', function () {
    creerAtelierAvecSeance('visible', true);

    Livewire::test(TrainingBookingCalendar::class)
        ->assertSee('Atelier visible');
});

test('le calendrier global n affiche pas un atelier désactivé', function () {
    creerAtelierAvecSeance('visible', true);
    creerAtelierAvecSeance('masque', false);

    Livewire::test(TrainingBookingCalendar::class)
        ->assertSee('Atelier visible')
        ->assertDontSee('Atelier masque');
});
