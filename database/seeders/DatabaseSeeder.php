<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Désactiver temporairement les contraintes de clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

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
         * SEEDERS ISSUS DE LA BASE RÉELLE (ISEED)
         * ============================================================
         */
        $this->call([
            CategoriesTableSeeder::class,
            TagsTableSeeder::class,
            TrainingsTableSeeder::class,
            PedagogicalDocumentsTableSeeder::class,
            CommentsTableSeeder::class,
            ProgressionsTableSeeder::class,
            TestimonialSeeder::class,
        ]);

        // Réactiver les contraintes de clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
