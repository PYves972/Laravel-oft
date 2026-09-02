<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::create([
            'author' => 'Marie L.',
            'role' => 'Élève Atelier Couture',
            'content' => 'Une super expérience ! J\'ai appris à manier ma machine à coudre en une seule séance avec un accueil très chaleureux.',
            'rating' => 5,
            'is_published' => true,
        ]);

        Testimonial::create([
            'author' => 'Sophie L.',
            'role' => 'Élève en couture',
            'content' => 'Une équipe à l\'écoute, des cours de qualité et une ambiance au top !',
            'rating' => 5,
            'is_published' => true,
        ]);
    }
}
