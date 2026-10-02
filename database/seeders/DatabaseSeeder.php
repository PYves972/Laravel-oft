<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Désactiver temporairement les contraintes de clés étrangères (compatible PostgreSQL)
        Schema::disableForeignKeyConstraints();

        /*
         * ============================================================
         * COMPTE ADMINISTRATEUR FILAMENT
         * ============================================================
         */
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin OFT',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

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
        Schema::enableForeignKeyConstraints();
    }
}
