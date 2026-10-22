<?php

use App\Models\Category;
use App\Models\Comment;
use App\Models\Training;
use App\Models\User;

function formationPourCommentaire(): int
{
    $category = Category::unguarded(fn () => Category::firstOrCreate(['slug' => 'couture'], ['name' => 'Couture']));

    return Training::unguarded(fn () => Training::create([
        'category_id' => $category->id,
        'title' => 'Atelier test',
        'slug' => 'atelier-test',
        'description' => 'Description',
        'duration_minutes' => 120,
        'price' => 45,
        'is_active' => true,
        'type' => 'atelier',
    ]))->id;
}

test('un visiteur ne peut pas poster un commentaire', function () {
    $this->post(route('comments.store'), [
        'training_id' => formationPourCommentaire(),
        'content' => 'Très bon atelier',
        'rating' => 5,
    ])->assertRedirect(route('login'));

    expect(Comment::count())->toBe(0);
});

test('un membre poste un commentaire en attente de modération', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('comments.store'), [
        'training_id' => formationPourCommentaire(),
        'content' => 'Très bon atelier',
        'rating' => 5,
    ])->assertRedirect();

    expect(Comment::count())->toBe(1);
    expect(Comment::first()->status)->toBe('pending');
    expect(Comment::first()->user_id)->toBe($user->id);
});

test('une note hors de 1 à 5 est refusée', function () {
    $this->actingAs(User::factory()->create())->post(route('comments.store'), [
        'training_id' => formationPourCommentaire(),
        'content' => 'Très bon atelier',
        'rating' => 9,
    ])->assertSessionHasErrors('rating');

    expect(Comment::count())->toBe(0);
});
