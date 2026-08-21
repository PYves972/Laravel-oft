<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
    }
}
