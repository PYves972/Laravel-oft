<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
         * ============================================================
         * SERVICES
         * ============================================================
         */

        Service::create([
            'titre' => 'Formations',
            'description' => 'Apprenez les bases ou perfectionnez vos techniques avec nos formations complètes.',
            'image' => 'images/formation.jpg',
            'lien' => '#',
        ]);

        Service::create([
            'titre' => 'Ateliers',
            'description' => 'Participez à nos ateliers créatifs et réalisez vos projets dans une ambiance conviviale.',
            'image' => 'images/atelier.jpg',
            'lien' => '#',
        ]);

        Service::create([
            'titre' => 'Confections',
            'description' => 'Des créations uniques et sur mesure, pensées pour vous.',
            'image' => 'images/confections.jpg',
            'lien' => '#',
        ]);

        /*
         * ============================================================
         * CATÉGORIES + ATELIERS + SÉANCES
         * ============================================================
         */

        $this->call([
            CategoryTrainingSeeder::class,
            TrainingSessionSeeder::class,
        ]);

        /*
         * ============================================================
         * TÉMOIGNAGES
         * ============================================================
         */

        Testimonial::create([
            'nom' => 'Sophie L.',
            'role' => 'Élève en couture',
            'contenu' => "Une équipe à l'écoute, des cours de qualité et une ambiance au top !",
            'avatar' => 'https://i.pravatar.cc/100?img=5',
        ]);

        Testimonial::create([
            'nom' => 'Julie M.',
            'role' => 'Cliente',
            'contenu' => "Grâce à l'atelier, j'ai pu réaliser ma robe de mariée. Un rêve devenu réalité !",
            'avatar' => 'https://i.pravatar.cc/100?img=9',
        ]);

        Testimonial::create([
            'nom' => 'Claire D.',
            'role' => 'Participante aux ateliers',
            'contenu' => 'Des ateliers variés et inspirants. Je recommande vivement !',
            'avatar' => 'https://i.pravatar.cc/100?img=16',
        ]);
    }
}
