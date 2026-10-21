<?php

use App\Models\Category;
use App\Models\Training;

function creerAtelier(string $slug, bool $actif): Training
{
    $category = Category::unguarded(fn () => Category::firstOrCreate(['slug' => 'couture'], ['name' => 'Couture']));

    return Training::unguarded(fn () => Training::create([
        'category_id' => $category->id,
        'title' => 'Atelier ' . $slug,
        'slug' => $slug,
        'description' => 'Description de test',
        'duration_minutes' => 120,
        'price' => 45,
        'is_active' => $actif,
        'type' => 'atelier',
    ]));
}

test('le catalogue des ateliers n affiche pas un atelier désactivé', function () {
    creerAtelier('visible', true);
    creerAtelier('masque', false);

    $this->get(route('trainings.workshops'))
        ->assertOk()
        ->assertSee('Atelier visible')
        ->assertDontSee('Atelier masque');
});

test('la fiche d un atelier désactivé est introuvable', function () {
    creerAtelier('masque', false);

    $this->get(route('ateliers.show', 'masque'))->assertNotFound();
});
