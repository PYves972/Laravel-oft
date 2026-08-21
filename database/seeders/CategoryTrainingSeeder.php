<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Training;
use App\Models\Tag;
use App\Models\TrainingSession;
use Illuminate\Database\Seeder;

class CategoryTrainingSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Création des catégories
        $couture = Category::create([
            'name' => 'Couture & Patronnage',
            'slug' => 'couture-patronnage',
            'description' => 'Apprenez les bases de la couture, la confection de vêtements et la réalisation de patrons sur-mesure.',
        ]);

        $retouche = Category::create([
            'name' => 'Retouches & Transformation',
            'slug' => 'retouches-transformation',
            'description' => 'Donnez une seconde vie à vos vêtements en apprenant les techniques de retouche et de customisation.',
        ]);

        // 2. Création des tags
        $tagDebutants = Tag::create(['name' => 'Débutant', 'slug' => 'debutant']);
        $tagPerfectionnement = Tag::create(['name' => 'Perfectionnement', 'slug' => 'perfectionnement']);
        $tagEco = Tag::create(['name' => 'Éco-responsable', 'slug' => 'eco-responsable']);

        // 3. Création d'une formation
        $training1 = Training::create([
            'category_id' => $couture->id,
            'title' => 'Initiation à la Machine à Coudre',
            'slug' => 'initiation-machine-a-coudre',
            'description' => 'Un atelier pratique pour prendre en main votre machine, enfiler les fils et réaliser vos premiers points en toute confiance.',
            'learning_objectives' => 'Comprendre le fonctionnement d\'une machine ; Réaliser des coutures droites et en courbe ; Confectionner un pochon simple.',
            'duration_minutes' => 180, // 3h
            'price' => 45.00,
            'is_active' => true,
        ]);

        $training1->tags()->attach([$tagDebutants->id, $tagEco->id]);

        // 4. Création de séances
        TrainingSession::create([
            'training_id' => $training1->id,
            'start_at' => now()->addDays(5)->setTime(9, 30),
            'end_at' => now()->addDays(5)->setTime(12, 30),
            'capacity_max' => 6,
            'status' => 'open',
        ]);

        TrainingSession::create([
            'training_id' => $training1->id,
            'start_at' => now()->addDays(12)->setTime(14, 0),
            'end_at' => now()->addDays(12)->setTime(17, 0),
            'capacity_max' => 6,
            'status' => 'open',
        ]);
    }
}
